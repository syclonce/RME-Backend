<?php

namespace Modules\PembayaranPayment\Services;

use App\Modules\Contracts\BillingGate;
use App\Modules\Contracts\CashierShiftGate;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\PembayaranCashierShift\Models\CashierShift;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPayment\Models\Payment;
use Modules\PembayaranPayment\Models\PaymentReversal;

class PaymentReversalService
{
    public function __construct(
        protected CashierShiftGate $cashierShiftGate,
        protected BillingGate $billingGate,
    ) {}

    public function reverse(Payment $payment, int $shiftId, string $reason, User $user): PaymentReversal
    {
        $cashierId = $this->cashierShiftGate->assertOpen($shiftId, $user);
        abort_if(trim($reason) === '', 422, 'Alasan reversal wajib diisi.');

        return DB::transaction(function () use ($payment, $shiftId, $cashierId, $reason, $user) {
            $locked = Payment::query()->whereKey($payment->id)->lockForUpdate()->firstOrFail();
            abort_unless($locked->status === 'completed', 422, 'Pembayaran tidak dapat direversal lagi.');
            abort_if(PaymentReversal::query()->where('payment_id', $locked->id)->exists(), 422, 'Pembayaran sudah direversal.');

            $originalCashierId = CashierShift::query()->whereKey($locked->cashier_shift_id)->value('cashier_id');
            abort_unless($originalCashierId === $cashierId, 403, 'Reversal hanya boleh dilakukan oleh kasir yang sama dengan transaksi asal.');

            $invoice = Invoice::query()->whereKey($locked->invoice_id)->lockForUpdate()->firstOrFail();
            $reversal = PaymentReversal::create([
                'payment_id' => $locked->id,
                'cashier_shift_id' => $shiftId,
                'reason' => trim($reason),
                'reversed_by' => $user->id,
                'reversed_at' => now(),
            ]);
            $locked->update(['status' => 'reversed']);

            $remaining = (float) Payment::query()->where('invoice_id', $invoice->id)
                ->where('status', 'completed')->sum('amount');
            if ($remaining < (float) $invoice->total_amount) {
                $this->billingGate->reopenAfterReversal($invoice->id);
            }

            return $reversal;
        });
    }
}
