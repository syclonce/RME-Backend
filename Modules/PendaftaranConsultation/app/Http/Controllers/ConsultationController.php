<?php

namespace Modules\PendaftaranConsultation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranConsultation\Http\Requests\StoreConsultationRequest;
use Modules\PendaftaranConsultation\Http\Resources\ConsultationResource;
use Modules\PendaftaranConsultation\Models\Consultation;
use Modules\PendaftaranConsultation\Services\ConsultationService;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $query = Consultation::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        // Daftar kerja unit tujuan: konsul masuk yang belum dijawab. Inilah
        // pemakaian utama endpoint ini bagi dokter penerima konsul.
        if ($request->filled('consulted_department_id')) {
            $query->where('consulted_department_id', $request->integer('consulted_department_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->boolean('pending_only')) {
            $query->pending();
        }

        return ConsultationResource::collection($query->latest('requested_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreConsultationRequest $request, ConsultationService $service)
    {
        $consultation = $service->request($request->validated(), $request->user());

        return (new ConsultationResource($consultation))->response()->setStatusCode(201);
    }

    /**
     * Jawab konsul — padanan `/pendaftaran/jawabankonsul` legacy.
     *
     * Endpoint tersendiri, bukan `update`, karena ini transisi keadaan yang
     * dilakukan unit LAIN (penerima konsul), bukan penyuntingan oleh pengirim.
     */
    public function answer(Request $request, Consultation $consultation, ConsultationService $service)
    {
        $validated = $request->validate([
            'answer' => ['required', 'string', 'min:3'],
        ]);

        $service->answer($consultation, $validated['answer'], $request->user());

        return new ConsultationResource($consultation->refresh());
    }

    /** Tarik konsul yang belum dijawab. */
    public function cancel(Consultation $consultation, ConsultationService $service): ConsultationResource
    {
        return new ConsultationResource($service->cancel($consultation));
    }

    public function show(Consultation $consultation): ConsultationResource
    {
        return new ConsultationResource($consultation);
    }
}
