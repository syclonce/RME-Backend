<?php

namespace Modules\GeneralTariffType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralTariffType\Models\TariffType;

class TariffTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(TariffType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tariff_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:tariff_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(TariffType::create($data)->refresh(), 201);
    }

    public function show(TariffType $tariffType): TariffType
    {
        return $tariffType;
    }

    public function update(Request $request, TariffType $tariffType): TariffType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('tariff_types', 'name')->ignore($tariffType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('tariff_types', 'code')->ignore($tariffType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $tariffType->update($data);

        return $tariffType;
    }

    public function destroy(TariffType $tariffType)
    {
        $tariffType->delete();

        return response()->json(null, 204);
    }
}