<?php

namespace Modules\MedicalRecordBarthelIndexAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordBarthelIndexAssessment\Http\Requests\StoreBarthelIndexAssessmentRequest;
use Modules\MedicalRecordBarthelIndexAssessment\Http\Requests\UpdateBarthelIndexAssessmentRequest;
use Modules\MedicalRecordBarthelIndexAssessment\Http\Resources\BarthelIndexAssessmentResource;
use Modules\MedicalRecordBarthelIndexAssessment\Models\BarthelIndexAssessment;

class BarthelIndexAssessmentController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = BarthelIndexAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return BarthelIndexAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreBarthelIndexAssessmentRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $data['assessed_at'] ??= now();

        // Total dihitung ulang di server, menimpa apa pun yang dikirim klien.
        // Skor ADL yang salah ketik bisa membuat kemandirian pasien tercatat
        // keliru tanpa tanda apa pun di layar. Kolom `interpretation` TIDAK
        // ditimpa: skema ini menyimpannya sebagai string bebas, bukan enum
        // dengan ambang baku yang terkunci di validasi.
        $data['total_score'] = BarthelIndexAssessment::calculateTotalScore($data);

        // Interpretasi diturunkan dari skor, bukan diketik terpisah — supaya
        // keduanya tidak pernah bertentangan (skor 100 berlabel "ketergantungan
        // total" adalah kesalahan yang tidak terlihat sampai ada yang membacanya).
        $data['interpretation'] = BarthelIndexAssessment::interpretationFor($data['total_score']);

        $record = BarthelIndexAssessment::create($data);

        return (new BarthelIndexAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(BarthelIndexAssessment $record): BarthelIndexAssessmentResource
    {
        return new BarthelIndexAssessmentResource($record);
    }

    public function update(UpdateBarthelIndexAssessmentRequest $request, BarthelIndexAssessment $record): BarthelIndexAssessmentResource
    {
        $record->update($request->validated());

        return new BarthelIndexAssessmentResource($record);
    }

    public function destroy(BarthelIndexAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
