<?php

namespace Modules\GeneralPatient\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\GeneralPatient\Http\Requests\StorePatientRequest;
use Modules\GeneralPatient\Http\Requests\UpdatePatientRequest;
use Modules\GeneralPatient\Http\Resources\PatientResource;
use Modules\GeneralPatient\Models\Patient;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->string('name').'%');
        }

        if ($request->filled('medical_record_number')) {
            $query->where('medical_record_number', $request->string('medical_record_number'));
        }

        return PatientResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    /**
     * Alur 1001 step 1: staff check whether the patient already exists
     * before creating a new record. Requires at least one of nik/name.
     */
    public function search(Request $request)
    {
        $request->validate([
            'nik' => ['nullable', 'digits:16'],
            'name' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
        ]);

        if (blank($request->input('nik')) && blank($request->input('name'))) {
            return response()->json(['message' => 'Isi NIK atau nama untuk mencari pasien.'], 422);
        }

        $matches = Patient::searchDuplicates(
            $request->string('nik')->toString() ?: null,
            $request->string('name')->toString() ?: null,
            $request->string('birth_date')->toString() ?: null,
        );

        return PatientResource::collection($matches);
    }

    public function store(StorePatientRequest $request)
    {
        $data = $request->validated();
        $data['registered_by'] = $request->user()->id;
        // Mode tak-dikenal: nama boleh kosong di validasi, tetapi kolom NOT NULL.
        $data['name'] ??= 'Tanpa Identitas';

        $patient = DB::transaction(function () use ($data) {
            $data['medical_record_number'] ??= Patient::generateMedicalRecordNumber();

            $patient = Patient::create(collect($data)->except(['is_infant', 'mother'])->all());

            if (! empty($data['mother']['name'])) {
                $patient->families()->create([
                    'name' => $data['mother']['name'],
                    'relationship' => 'ibu',
                    'identity_number' => $data['mother']['identity_number'] ?? null,
                    'is_active' => true,
                ]);
            }

            return $patient;
        });

        return (new PatientResource($patient))->response()->setStatusCode(201);
    }

    public function show(Patient $patient): PatientResource
    {
        $resource = new PatientResource($patient);
        $resource->withSatuSehatStatus = true;

        return $resource;
    }

    public function update(UpdatePatientRequest $request, Patient $patient): PatientResource
    {
        $patient->update($request->validated());

        return new PatientResource($patient);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json(null, 204);
    }
}
