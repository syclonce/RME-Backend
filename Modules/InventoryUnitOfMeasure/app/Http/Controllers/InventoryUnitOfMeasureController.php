<?php

namespace Modules\InventoryUnitOfMeasure\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\InventoryUnitOfMeasure\Models\UnitOfMeasure;

class InventoryUnitOfMeasureController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(UnitOfMeasure::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:unit_of_measures,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:unit_of_measures,code'],
            'abbreviation' => ['nullable', 'string', 'max:20'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(UnitOfMeasure::create($data)->refresh(), 201);
    }

    public function show(UnitOfMeasure $inventoryunitofmeasure): UnitOfMeasure
    {
        return $inventoryunitofmeasure;
    }

    public function update(Request $request, UnitOfMeasure $inventoryunitofmeasure): UnitOfMeasure
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('unit_of_measures', 'name')->ignore($inventoryunitofmeasure->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('unit_of_measures', 'code')->ignore($inventoryunitofmeasure->id)],
            'abbreviation' => ['nullable', 'string', 'max:20'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $inventoryunitofmeasure->update($data);

        return $inventoryunitofmeasure;
    }

    public function destroy(UnitOfMeasure $inventoryunitofmeasure)
    {
        $inventoryunitofmeasure->delete();

        return response()->json(null, 204);
    }
}
