<?php

namespace Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Http\Requests\StoreHumptyDumptyFallScaleAssessmentRequest;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Http\Resources\HumptyDumptyFallScaleAssessmentResource;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Models\HumptyDumptyFallScaleAssessment;

class HumptyDumptyFallScaleAssessmentController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = HumptyDumptyFallScaleAssessment::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return HumptyDumptyFallScaleAssessmentResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreHumptyDumptyFallScaleAssessmentRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'assessed_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        // Total dan tingkat risiko dihitung ulang di server, menimpa apa pun yang
        // dikirim klien. Skor risiko jatuh yang salah ketik akan menghilangkan
        // kewaspadaan perawat tanpa tanda apa pun di layar.
        $data['total_score'] = HumptyDumptyFallScaleAssessment::calculateTotalScore($data);
        $data['risk_level'] = HumptyDumptyFallScaleAssessment::riskLevelFor($data['total_score']);

        $record = HumptyDumptyFallScaleAssessment::create($data);

        return (new HumptyDumptyFallScaleAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(HumptyDumptyFallScaleAssessment $record): HumptyDumptyFallScaleAssessmentResource
    {
        return new HumptyDumptyFallScaleAssessmentResource($record);
    }
}
