<?php

namespace Modules\GeneralPatientStatus\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPatientStatus\Models\PatientStatus;

class PatientStatusController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(PatientStatus::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:patient_statuses,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:patient_statuses,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PatientStatus::create($data)->refresh(), 201);
    }

    public function show(PatientStatus $patientStatus): PatientStatus
    {
        return $patientStatus;
    }

    public function update(Request $request, PatientStatus $patientStatus): PatientStatus
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('patient_statuses', 'name')->ignore($patientStatus->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('patient_statuses', 'code')->ignore($patientStatus->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $patientStatus->update($data);

        return $patientStatus;
    }

    public function destroy(PatientStatus $patientStatus)
    {
        $patientStatus->delete();

        return response()->json(null, 204);
    }
}