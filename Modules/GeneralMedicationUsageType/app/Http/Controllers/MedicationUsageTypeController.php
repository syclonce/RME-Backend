<?php

namespace Modules\GeneralMedicationUsageType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralMedicationUsageType\Models\MedicationUsageType;

class MedicationUsageTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(MedicationUsageType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:medication_usage_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:medication_usage_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(MedicationUsageType::create($data)->refresh(), 201);
    }

    public function show(MedicationUsageType $medicationUsageType): MedicationUsageType
    {
        return $medicationUsageType;
    }

    public function update(Request $request, MedicationUsageType $medicationUsageType): MedicationUsageType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('medication_usage_types', 'name')->ignore($medicationUsageType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('medication_usage_types', 'code')->ignore($medicationUsageType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $medicationUsageType->update($data);

        return $medicationUsageType;
    }

    public function destroy(MedicationUsageType $medicationUsageType)
    {
        $medicationUsageType->delete();

        return response()->json(null, 204);
    }
}