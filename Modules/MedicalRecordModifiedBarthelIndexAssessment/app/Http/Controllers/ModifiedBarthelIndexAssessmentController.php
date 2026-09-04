<?php

namespace Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Requests\StoreModifiedBarthelIndexAssessmentRequest;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Requests\UpdateModifiedBarthelIndexAssessmentRequest;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Resources\ModifiedBarthelIndexAssessmentResource;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Models\ModifiedBarthelIndexAssessment;

class ModifiedBarthelIndexAssessmentController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = ModifiedBarthelIndexAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ModifiedBarthelIndexAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreModifiedBarthelIndexAssessmentRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $data['assessed_at'] ??= now();

        // Total dihitung ulang di server, menimpa apa pun yang dikirim klien.
        // Skor ADL yang salah ketik bisa membuat tingkat ketergantungan pasien
        // tercatat keliru tanpa tanda apa pun di layar. Kolom `interpretation`
        // TIDAK ditimpa: skema ini menyimpannya sebagai string bebas, bukan enum
        // dengan ambang baku yang terkunci di validasi.
        $data['total_score'] = ModifiedBarthelIndexAssessment::calculateTotalScore($data);

        // Interpretasi diturunkan dari skor agar keduanya tidak pernah bertentangan.
        $data['interpretation'] = ModifiedBarthelIndexAssessment::interpretationFor($data['total_score']);

        $record = ModifiedBarthelIndexAssessment::create($data);

        return (new ModifiedBarthelIndexAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(ModifiedBarthelIndexAssessment $record): ModifiedBarthelIndexAssessmentResource
    {
        return new ModifiedBarthelIndexAssessmentResource($record);
    }

    public function update(UpdateModifiedBarthelIndexAssessmentRequest $request, ModifiedBarthelIndexAssessment $record): ModifiedBarthelIndexAssessmentResource
    {
        $record->update($request->validated());

        return new ModifiedBarthelIndexAssessmentResource($record);
    }

    public function destroy(ModifiedBarthelIndexAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
