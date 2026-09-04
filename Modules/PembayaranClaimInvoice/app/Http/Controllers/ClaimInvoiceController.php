<?php

namespace Modules\PembayaranClaimInvoice\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranClaimInvoice\Http\Requests\StoreClaimInvoiceRequest;
use Modules\PembayaranClaimInvoice\Http\Requests\TransitionClaimInvoiceRequest;
use Modules\PembayaranClaimInvoice\Http\Requests\UpdateClaimInvoiceRequest;
use Modules\PembayaranClaimInvoice\Http\Resources\ClaimInvoiceResource;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;
use Modules\PembayaranClaimInvoice\Services\ClaimInvoiceService;

class ClaimInvoiceController extends Controller
{
    public function __construct(protected ClaimInvoiceService $service) {}

    public function index(Request $request)
    {
        $query = ClaimInvoice::query();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        return ClaimInvoiceResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreClaimInvoiceRequest $request)
    {
        $claimInvoice = $this->service->create($request->validated());

        return (new ClaimInvoiceResource($claimInvoice))->response()->setStatusCode(201);
    }

    public function show(ClaimInvoice $claim_invoice): ClaimInvoiceResource
    {
        return new ClaimInvoiceResource($claim_invoice);
    }

    /**
     * Update non-status metadata saja (claim_number). Transisi status lewat
     * transition() - lihat komentar UpdateClaimInvoiceRequest.
     */
    public function update(UpdateClaimInvoiceRequest $request, ClaimInvoice $claim_invoice): ClaimInvoiceResource
    {
        $claim_invoice->update($request->validated());

        return new ClaimInvoiceResource($claim_invoice);
    }

    public function transition(TransitionClaimInvoiceRequest $request, ClaimInvoice $claim_invoice): ClaimInvoiceResource
    {
        $data = $request->validated();
        $claim = $this->service->transition($claim_invoice, $data['status'], $data);

        return new ClaimInvoiceResource($claim);
    }

    public function destroy(ClaimInvoice $claim_invoice)
    {
        $claim_invoice->delete();

        return response()->json(null, 204);
    }
}
