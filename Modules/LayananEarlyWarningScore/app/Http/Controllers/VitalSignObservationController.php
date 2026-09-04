<?php

namespace Modules\LayananEarlyWarningScore\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\LayananEarlyWarningScore\Http\Requests\StoreVitalSignObservationRequest;
use Modules\LayananEarlyWarningScore\Models\VitalSignObservation;
use Modules\LayananEarlyWarningScore\Services\VitalSignObservationService;

/**
 * Controller sengaja tipis: satu-satunya aksi tulis (store) langsung
 * didelegasikan ke VitalSignObservationService — pembuatan model + skoring
 * NEWS2 tidak pernah dilakukan di sini (pelajaran dari bug bypass-service).
 */
class VitalSignObservationController extends Controller
{
    use ResolvesActingEmployee;

    public function __construct(protected VitalSignObservationService $service) {}

    public function index(Request $request): JsonResponse
    {
        $query = VitalSignObservation::query()
            ->with('visit')
            // Filter visit_id: layar rawat inap membaca riwayat vital per kunjungan.
            ->when($request->filled('visit_id'), fn ($q) => $q->where('visit_id', $request->integer('visit_id')))
            ->orderByDesc('recorded_at')
            ->orderByDesc('id');

        return response()->json($query->paginate($request->integer('per_page', 15)));
    }

    public function show(VitalSignObservation $vital_sign_observation): JsonResponse
    {
        return response()->json(['data' => $vital_sign_observation]);
    }

    public function store(StoreVitalSignObservationRequest $request): JsonResponse
    {
        $observation = $this->service->store($this->fillActingEmployee($request, $request->validated(), 'recorded_by'));

        // 201 + skor hasil kalkulasi server, bukan apa pun yang dikirim klien.
        return response()->json(['data' => $observation], 201);
    }
}
