<?php

namespace Modules\GeneralPatientType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPatientType\Models\PatientType;

class PatientTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(PatientType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:patient_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:patient_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PatientType::create($data)->refresh(), 201);
    }

    public function show(PatientType $patientType): PatientType
    {
        return $patientType;
    }

    public function update(Request $request, PatientType $patientType): PatientType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('patient_types', 'name')->ignore($patientType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('patient_types', 'code')->ignore($patientType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $patientType->update($data);

        return $patientType;
    }

    public function destroy(PatientType $patientType)
    {
        $patientType->delete();

        return response()->json(null, 204);
    }
}