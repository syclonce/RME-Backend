<?php

namespace Modules\MedicalRecordCoughAssessment\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordCoughAssessment\Http\Requests\StoreCoughAssessmentRequest;
use Modules\MedicalRecordCoughAssessment\Http\Requests\UpdateCoughAssessmentRequest;
use Modules\MedicalRecordCoughAssessment\Http\Resources\CoughAssessmentResource;
use Modules\MedicalRecordCoughAssessment\Models\CoughAssessment;

class CoughAssessmentController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = CoughAssessment::query();

        return CoughAssessmentResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreCoughAssessmentRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'assessed_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['has_cough'] ??= false;
        $data['is_referred_tb_screening'] ??= false;

        $record = CoughAssessment::create($data);

        return (new CoughAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(CoughAssessment $record): CoughAssessmentResource
    {
        return new CoughAssessmentResource($record);
    }

    public function update(UpdateCoughAssessmentRequest $request, CoughAssessment $record): CoughAssessmentResource
    {
        $record->update($request->validated());

        return new CoughAssessmentResource($record);
    }

    public function destroy(CoughAssessment $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
