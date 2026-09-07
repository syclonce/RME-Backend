<?php

namespace Modules\GeneralLaboratoryUnit\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralLaboratoryUnit\Models\LaboratoryUnit;

class LaboratoryUnitController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(LaboratoryUnit::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:laboratory_units,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:laboratory_units,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(LaboratoryUnit::create($data)->refresh(), 201);
    }

    public function show(LaboratoryUnit $laboratoryUnit): LaboratoryUnit
    {
        return $laboratoryUnit;
    }

    public function update(Request $request, LaboratoryUnit $laboratoryUnit): LaboratoryUnit
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('laboratory_units', 'name')->ignore($laboratoryUnit->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('laboratory_units', 'code')->ignore($laboratoryUnit->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $laboratoryUnit->update($data);

        return $laboratoryUnit;
    }

    public function destroy(LaboratoryUnit $laboratoryUnit)
    {
        $laboratoryUnit->delete();

        return response()->json(null, 204);
    }
}