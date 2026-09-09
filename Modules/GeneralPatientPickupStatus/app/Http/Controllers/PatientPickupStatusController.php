<?php

namespace Modules\GeneralPatientPickupStatus\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPatientPickupStatus\Models\PatientPickupStatus;

class PatientPickupStatusController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(PatientPickupStatus::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:patient_pickup_statuses,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:patient_pickup_statuses,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PatientPickupStatus::create($data)->refresh(), 201);
    }

    public function show(PatientPickupStatus $patientPickupStatus): PatientPickupStatus
    {
        return $patientPickupStatus;
    }

    public function update(Request $request, PatientPickupStatus $patientPickupStatus): PatientPickupStatus
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('patient_pickup_statuses', 'name')->ignore($patientPickupStatus->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('patient_pickup_statuses', 'code')->ignore($patientPickupStatus->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $patientPickupStatus->update($data);

        return $patientPickupStatus;
    }

    public function destroy(PatientPickupStatus $patientPickupStatus)
    {
        $patientPickupStatus->delete();

        return response()->json(null, 204);
    }
}