<?php

namespace Modules\MedicalRecordTumorAssessment\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordTumorAssessment\Http\Requests\StoreTumorAssessmentRequest;
use Modules\MedicalRecordTumorAssessment\Http\Resources\TumorAssessmentResource;
use Modules\MedicalRecordTumorAssessment\Models\TumorAssessment;

class TumorAssessmentController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = TumorAssessment::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return TumorAssessmentResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTumorAssessmentRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'assessed_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = TumorAssessment::create($data);

        return (new TumorAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(TumorAssessment $record): TumorAssessmentResource
    {
        return new TumorAssessmentResource($record);
    }
}
