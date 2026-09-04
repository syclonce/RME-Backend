<?php

namespace Modules\MedicalRecordLowerGiTractExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordLowerGiTractExamination\Http\Requests\StoreLowerGiTractExaminationRequest;
use Modules\MedicalRecordLowerGiTractExamination\Http\Requests\UpdateLowerGiTractExaminationRequest;
use Modules\MedicalRecordLowerGiTractExamination\Http\Resources\LowerGiTractExaminationResource;
use Modules\MedicalRecordLowerGiTractExamination\Models\LowerGiTractExamination;

class LowerGiTractExaminationController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = LowerGiTractExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return LowerGiTractExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreLowerGiTractExaminationRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $data['examined_at'] ??= now();

        $record = LowerGiTractExamination::create($data);

        return (new LowerGiTractExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(LowerGiTractExamination $record): LowerGiTractExaminationResource
    {
        return new LowerGiTractExaminationResource($record);
    }

    public function update(UpdateLowerGiTractExaminationRequest $request, LowerGiTractExamination $record): LowerGiTractExaminationResource
    {
        $record->update($request->validated());

        return new LowerGiTractExaminationResource($record);
    }

    public function destroy(LowerGiTractExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
