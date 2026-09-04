<?php

namespace Modules\MedicalRecordFingerExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordFingerExamination\Http\Requests\StoreFingerExaminationRequest;
use Modules\MedicalRecordFingerExamination\Http\Requests\UpdateFingerExaminationRequest;
use Modules\MedicalRecordFingerExamination\Http\Resources\FingerExaminationResource;
use Modules\MedicalRecordFingerExamination\Models\FingerExamination;

class FingerExaminationController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = FingerExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return FingerExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreFingerExaminationRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['hand_side'] ??= 'both';
        $data['clubbing'] ??= false;
        $data['cyanosis'] ??= false;
        $data['examined_at'] ??= now();

        $record = FingerExamination::create($data);

        return (new FingerExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(FingerExamination $record): FingerExaminationResource
    {
        return new FingerExaminationResource($record);
    }

    public function update(UpdateFingerExaminationRequest $request, FingerExamination $record): FingerExaminationResource
    {
        $record->update($request->validated());

        return new FingerExaminationResource($record);
    }

    public function destroy(FingerExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
