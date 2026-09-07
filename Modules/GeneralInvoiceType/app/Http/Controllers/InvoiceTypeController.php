<?php

namespace Modules\GeneralInvoiceType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralInvoiceType\Models\InvoiceType;

class InvoiceTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(InvoiceType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:invoice_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:invoice_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(InvoiceType::create($data)->refresh(), 201);
    }

    public function show(InvoiceType $invoiceType): InvoiceType
    {
        return $invoiceType;
    }

    public function update(Request $request, InvoiceType $invoiceType): InvoiceType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('invoice_types', 'name')->ignore($invoiceType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('invoice_types', 'code')->ignore($invoiceType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $invoiceType->update($data);

        return $invoiceType;
    }

    public function destroy(InvoiceType $invoiceType)
    {
        $invoiceType->delete();

        return response()->json(null, 204);
    }
}