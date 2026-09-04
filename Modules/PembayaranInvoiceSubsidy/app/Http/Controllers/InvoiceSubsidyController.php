<?php

namespace Modules\PembayaranInvoiceSubsidy\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranInvoiceSubsidy\Http\Requests\StoreInvoiceSubsidyRequest;
use Modules\PembayaranInvoiceSubsidy\Http\Requests\TransitionInvoiceSubsidyRequest;
use Modules\PembayaranInvoiceSubsidy\Http\Requests\UpdateInvoiceSubsidyRequest;
use Modules\PembayaranInvoiceSubsidy\Http\Resources\InvoiceSubsidyResource;
use Modules\PembayaranInvoiceSubsidy\Models\InvoiceSubsidy;
use Modules\PembayaranInvoiceSubsidy\Services\InvoiceSubsidyService;

class InvoiceSubsidyController extends Controller
{
    public function __construct(protected InvoiceSubsidyService $service) {}

    public function index(Request $request)
    {
        $query = InvoiceSubsidy::query();

        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->integer('invoice_id'));
        }

        return InvoiceSubsidyResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInvoiceSubsidyRequest $request)
    {
        $subsidy = $this->service->create($request->validated());

        return (new InvoiceSubsidyResource($subsidy))->response()->setStatusCode(201);
    }

    public function show(InvoiceSubsidy $invoice_subsidy): InvoiceSubsidyResource
    {
        return new InvoiceSubsidyResource($invoice_subsidy);
    }

    /**
     * Update non-status metadata saja (subsidy_source/subsidy_amount/notes).
     * Transisi status lewat transition() - lihat komentar
     * UpdateInvoiceSubsidyRequest.
     */
    public function update(UpdateInvoiceSubsidyRequest $request, InvoiceSubsidy $invoice_subsidy): InvoiceSubsidyResource
    {
        $invoice_subsidy->update($request->validated());

        return new InvoiceSubsidyResource($invoice_subsidy);
    }

    public function transition(TransitionInvoiceSubsidyRequest $request, InvoiceSubsidy $invoice_subsidy): InvoiceSubsidyResource
    {
        $subsidy = $this->service->transition($invoice_subsidy, $request->validated('status'), $request->user());

        return new InvoiceSubsidyResource($subsidy);
    }

    public function destroy(InvoiceSubsidy $invoice_subsidy)
    {
        $invoice_subsidy->delete();

        return response()->json(null, 204);
    }
}
