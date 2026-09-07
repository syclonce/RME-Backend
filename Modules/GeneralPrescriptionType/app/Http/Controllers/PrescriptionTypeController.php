<?php

namespace Modules\GeneralPrescriptionType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPrescriptionType\Models\PrescriptionType;

class PrescriptionTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(PrescriptionType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:prescription_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:prescription_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PrescriptionType::create($data)->refresh(), 201);
    }

    public function show(PrescriptionType $prescriptionType): PrescriptionType
    {
        return $prescriptionType;
    }

    public function update(Request $request, PrescriptionType $prescriptionType): PrescriptionType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('prescription_types', 'name')->ignore($prescriptionType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('prescription_types', 'code')->ignore($prescriptionType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $prescriptionType->update($data);

        return $prescriptionType;
    }

    public function destroy(PrescriptionType $prescriptionType)
    {
        $prescriptionType->delete();

        return response()->json(null, 204);
    }
}