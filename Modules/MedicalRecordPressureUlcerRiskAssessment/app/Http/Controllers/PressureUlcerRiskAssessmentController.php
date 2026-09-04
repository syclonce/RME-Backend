<?php

namespace Modules\MedicalRecordPressureUlcerRiskAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Http\Requests\StorePressureUlcerRiskAssessmentRequest;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Http\Requests\UpdatePressureUlcerRiskAssessmentRequest;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Http\Resources\PressureUlcerRiskAssessmentResource;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Models\PressureUlcerRiskAssessment;

class PressureUlcerRiskAssessmentController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = PressureUlcerRiskAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PressureUlcerRiskAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StorePressureUlcerRiskAssessmentRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $data['assessed_at'] ??= now();

        // Total dan tingkat risiko dihitung ulang di server, menimpa apa pun yang
        // dikirim klien. Skala Braden yang salah ketik bisa menghilangkan
        // intervensi pencegahan luka tekan tanpa tanda apa pun di layar.
        $data['total_score'] = PressureUlcerRiskAssessment::calculateTotalScore($data);
        $data['risk_level'] = PressureUlcerRiskAssessment::riskLevelFor($data['total_score']);

        $record = PressureUlcerRiskAssessment::create($data);

        return (new PressureUlcerRiskAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(PressureUlcerRiskAssessment $record): PressureUlcerRiskAssessmentResource
    {
        return new PressureUlcerRiskAssessmentResource($record);
    }

    public function update(UpdatePressureUlcerRiskAssessmentRequest $request, PressureUlcerRiskAssessment $record): PressureUlcerRiskAssessmentResource
    {
        $record->update($request->validated());

        return new PressureUlcerRiskAssessmentResource($record);
    }

    public function destroy(PressureUlcerRiskAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
