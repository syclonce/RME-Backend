<?php

namespace Modules\MedicalRecordDifferentialDiagnosis\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordDifferentialDiagnosis\Http\Requests\StoreDifferentialDiagnosisRequest;
use Modules\MedicalRecordDifferentialDiagnosis\Http\Requests\UpdateDifferentialDiagnosisRequest;
use Modules\MedicalRecordDifferentialDiagnosis\Http\Resources\DifferentialDiagnosisResource;
use Modules\MedicalRecordDifferentialDiagnosis\Models\DifferentialDiagnosis;

class DifferentialDiagnosisController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = DifferentialDiagnosis::query();

        return DifferentialDiagnosisResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDifferentialDiagnosisRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['status'] ??= 'considered';

        $record = DifferentialDiagnosis::create($data);

        return (new DifferentialDiagnosisResource($record))->response()->setStatusCode(201);
    }

    public function show(DifferentialDiagnosis $record): DifferentialDiagnosisResource
    {
        return new DifferentialDiagnosisResource($record);
    }

    public function update(UpdateDifferentialDiagnosisRequest $request, DifferentialDiagnosis $record): DifferentialDiagnosisResource
    {
        $record->update($request->validated());

        return new DifferentialDiagnosisResource($record);
    }

    public function destroy(DifferentialDiagnosis $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
