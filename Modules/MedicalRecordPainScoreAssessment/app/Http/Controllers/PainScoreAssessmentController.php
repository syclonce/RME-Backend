<?php

namespace Modules\MedicalRecordPainScoreAssessment\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordPainScoreAssessment\Http\Requests\StorePainScoreAssessmentRequest;
use Modules\MedicalRecordPainScoreAssessment\Http\Resources\PainScoreAssessmentResource;
use Modules\MedicalRecordPainScoreAssessment\Models\PainScoreAssessment;

class PainScoreAssessmentController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = PainScoreAssessment::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PainScoreAssessmentResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePainScoreAssessmentRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'assessed_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = PainScoreAssessment::create($data);

        return (new PainScoreAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(PainScoreAssessment $record): PainScoreAssessmentResource
    {
        return new PainScoreAssessmentResource($record);
    }
}
