<?php

namespace Modules\PembayaranPayment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\ServiceEpisodeGate;
use App\Modules\Contracts\CashierShiftGate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoice\Services\InvoiceService;
use Modules\PembayaranPayment\Http\Requests\StorePaymentRequest;
use Modules\PembayaranPayment\Http\Resources\PaymentResource;
use Modules\PembayaranPayment\Models\Payment;
use Modules\PembayaranPayment\Services\PaymentReversalService;

class PaymentController extends Controller
{
    public function __construct(
        protected InvoiceService $invoiceService,
        protected ServiceEpisodeGate $serviceEpisodeGate,
        protected CashierShiftGate $cashierShiftGate,
    ) {}

    public function index(Request $request)
    {
        $query = Payment::query();

        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->integer('invoice_id'));
        }

        return PaymentResource::collection($query->latest('paid_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Payments are financial records, not freely editable/deletable once made -
     * only index/store/show. Corrections belong in a reversal entry, not in scope yet.
     */
    public function store(StorePaymentRequest $request)
    {
        $data = $request->validated();
        $visitId = (int) Invoice::query()->whereKey($data['invoice_id'])->value('visit_id');
        $this->serviceEpisodeGate->assertFinalized($visitId);
        $this->cashierShiftGate->assertOpen((int) $data['cashier_shift_id'], $request->user());
        $data['payment_number'] ??= Payment::generatePaymentNumber();
        $data['paid_at'] ??= now();
        $data['received_by'] = $request->user()->id;

        // Idempotency (padanan "tunai upsert" legacy): kunci yang pernah
        // dipakai mengembalikan baris aslinya (200), bukan membuat ganda.
        // Dicek di DALAM transaksi + lock agar dua request serentak dengan
        // kunci sama tidak lolos berdua (unique DB sebagai jaring terakhir).
        if (! empty($data['idempotency_key'])) {
            $existing = Payment::query()->where('idempotency_key', $data['idempotency_key'])->first();

            if ($existing !== null) {
                return (new PaymentResource($existing))->response()->setStatusCode(200);
            }
        }

        $payment = DB::transaction(function () use ($data) {
            $invoice = Invoice::query()->whereKey($data['invoice_id'])->lockForUpdate()->firstOrFail();

            abort_if($invoice->is_locked, 422, 'Tagihan ini sudah lunas dan dikunci.');
            abort_if($invoice->status === 'cancelled', 422, 'Tagihan ini sudah dibatalkan.');

            $alreadyPaid = (float) $invoice->payments()->where('status', 'completed')->sum('amount');
            $outstanding = (float) $invoice->total_amount - $alreadyPaid;

            abort_if(
                (float) $data['amount'] > $outstanding,
                422,
                'Jumlah pembayaran melebihi sisa tagihan.'
            );

            $payment = Payment::create($data);

            if ($alreadyPaid + (float) $data['amount'] >= (float) $invoice->total_amount) {
                $this->invoiceService->markPaid($invoice->id);
            }

            return $payment;
        });

        return (new PaymentResource($payment))->response()->setStatusCode(201);
    }

    public function show(Payment $payment): PaymentResource
    {
        return new PaymentResource($payment);
    }

    public function reverse(Request $request, Payment $payment, PaymentReversalService $service)
    {
        $data = $request->validate([
            'cashier_shift_id' => ['required', 'integer', 'exists:cashier_shifts,id'],
            'reason' => ['required', 'string', 'max:2000'],
        ]);
        $reversal = $service->reverse($payment, (int) $data['cashier_shift_id'], $data['reason'], $request->user());

        return response()->json(['data' => $reversal], 201);
    }
}
