<?php

namespace Modules\MedicalRecordMorseFallScaleAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordMorseFallScaleAssessment\Http\Requests\StoreMorseFallScaleAssessmentRequest;
use Modules\MedicalRecordMorseFallScaleAssessment\Http\Resources\MorseFallScaleAssessmentResource;
use Modules\MedicalRecordMorseFallScaleAssessment\Models\MorseFallScaleAssessment;

class MorseFallScaleAssessmentController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = MorseFallScaleAssessment::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return MorseFallScaleAssessmentResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMorseFallScaleAssessmentRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        // Total dan tingkat risiko dihitung ulang di server, menimpa apa pun yang
        // dikirim klien. Skor risiko jatuh yang salah ketik akan menghilangkan
        // kewaspadaan perawat tanpa tanda apa pun di layar.
        $data['total_score'] = MorseFallScaleAssessment::calculateTotalScore($data);
        $data['risk_level'] = MorseFallScaleAssessment::riskLevelFor($data['total_score']);

        $record = MorseFallScaleAssessment::create($data);

        return (new MorseFallScaleAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(MorseFallScaleAssessment $record): MorseFallScaleAssessmentResource
    {
        return new MorseFallScaleAssessmentResource($record);
    }
}
