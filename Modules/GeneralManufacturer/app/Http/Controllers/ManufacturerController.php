<?php

namespace Modules\GeneralManufacturer\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralManufacturer\Models\Manufacturer;

class ManufacturerController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(Manufacturer::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:manufacturers,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:manufacturers,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Manufacturer::create($data)->refresh(), 201);
    }

    public function show(Manufacturer $manufacturer): Manufacturer
    {
        return $manufacturer;
    }

    public function update(Request $request, Manufacturer $manufacturer): Manufacturer
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('manufacturers', 'name')->ignore($manufacturer->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('manufacturers', 'code')->ignore($manufacturer->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $manufacturer->update($data);

        return $manufacturer;
    }

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return response()->json(null, 204);
    }
}