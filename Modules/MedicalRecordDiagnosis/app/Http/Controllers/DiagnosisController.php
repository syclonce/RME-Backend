<?php

namespace Modules\MedicalRecordDiagnosis\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\MedicalRecordDiagnosis\Http\Requests\StoreDiagnosisRequest;
use Modules\MedicalRecordDiagnosis\Http\Resources\DiagnosisResource;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class DiagnosisController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ]);

        $query = Diagnosis::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DiagnosisResource::collection($query->latest('recorded_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDiagnosisRequest $request, MedicalRecordGate $medicalRecordGate)
    {
        $data = $request->validated();
        $medicalRecordGate->assertWritable((int) $data['visit_id'], $request->user());
        $data['recorded_at'] ??= now();
        $data['recorded_by'] = $request->user()->id;

        $diagnosis = DB::transaction(function () use ($data) {
            if ($data['is_primary'] ?? false) {
                Diagnosis::where('visit_id', $data['visit_id'])->update(['is_primary' => false]);
            }
            return Diagnosis::create($data);
        });

        return (new DiagnosisResource($diagnosis))->response()->setStatusCode(201);
    }

    public function show(Diagnosis $diagnosis): DiagnosisResource
    {
        return new DiagnosisResource($diagnosis);
    }

    public function destroy(Request $request, Diagnosis $diagnosis, MedicalRecordGate $medicalRecordGate)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($diagnosis)]);

        $medicalRecordGate->assertWritable((int) $diagnosis->visit_id, $request->user());
        $diagnosis->delete();

        return response()->json(null, 204);
    }
}
