<?php

namespace Modules\GeneralSalesTax\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSalesTax\Models\SalesTax;

class SalesTaxController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SalesTax::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sales_taxes,name'],
            'rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SalesTax::create($data)->refresh(), 201);
    }

    public function show(SalesTax $sales_tax): SalesTax
    {
        return $sales_tax;
    }

    public function update(Request $request, SalesTax $sales_tax): SalesTax
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sales_taxes', 'name')->ignore($sales_tax->id)],
            'rate' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sales_tax->update($data);

        return $sales_tax;
    }

    public function destroy(SalesTax $sales_tax)
    {
        $sales_tax->delete();

        return response()->json(null, 204);
    }
}
