<?php

namespace Modules\PendaftaranVisit\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\WardScope;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\PendaftaranVisit\Services\VisitService;
use Modules\PendaftaranVisit\Services\VisitFinalizationService;
use Modules\PendaftaranVisit\Http\Requests\StoreVisitRequest;
use Modules\PendaftaranVisit\Http\Requests\UpdateVisitRequest;
use Modules\PendaftaranVisit\Http\Resources\VisitResource;
use Modules\PendaftaranVisit\Models\Visit;

class VisitController extends Controller
{
    public function __construct(protected WardScope $wardScope) {}

    public function index(Request $request)
    {
        $query = Visit::query();

        if ($request->filled('registration_id')) {
            $query->where('registration_id', $request->integer('registration_id'));
        }

        // Filter status (mis. ?status=active) — kolom ada langsung di visits.
        // Dipakai halaman Triase IGD supaya tidak perlu tarik semua baris lalu
        // filter di klien.
        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        // Filter is_emergency — kolomnya ada di registrations, bukan visits,
        // jadi harus lewat whereHas ke relasi registration(). Sama alasannya
        // dengan filter status: dukung Triase IGD tanpa gabung manual di klien.
        if ($request->filled('is_emergency')) {
            $isEmergency = $request->boolean('is_emergency');
            $query->whereHas('registration', fn ($q) => $q->where('is_emergency', $isEmergency));
        }

        // Baca juga di-scope ward (#3): petugas cuma lihat kunjungan rawat
        // jalan (ward_id null) + kunjungan di ward tempat dia ditugaskan.
        // Sama seperti gerbang tulis: admin bebas, petugas tanpa assignment
        // sama sekali masih default terbuka (rollout bertahap).
        $user = $request->user();
        if (! $user->hasRole('admin')) {
            $assigned = $this->wardScope->assignedWardIds($user->id);
            if ($assigned !== []) {
                $query->where(fn ($q) => $q->whereNull('ward_id')->orWhereIn('ward_id', $assigned));
            }
        }

        return VisitResource::collection($query->latest('admitted_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreVisitRequest $request, VisitService $service)
    {
        // Gerbang admission ala simgos2 ada di VisitService::admit().
        $visit = $service->admit($request->validated(), $request->user());

        return (new VisitResource($visit))->response()->setStatusCode(201);
    }

    public function show(Request $request, Visit $visit): VisitResource
    {
        abort_if(
            ! $this->wardScope->canAccessWard($request->user(), $visit->ward_id),
            403,
            'Anda tidak ditugaskan ke ward kunjungan ini.',
        );

        return new VisitResource($visit);
    }

    public function update(UpdateVisitRequest $request, Visit $visit, VisitService $service): VisitResource
    {
        $data = $request->validated();

        // Gerbang pulang tidak boleh dilewati lewat edit bebas: bed harus
        // dibebaskan dan rekam pulang dibuat oleh VisitService::discharge().
        abort_if(
            array_key_exists('discharged_at', $data) || ($data['status'] ?? null) === 'discharged',
            422,
            'Pulangkan kunjungan melalui POST /visits/{visit}/discharge.',
        );

        // Gerbang mutasi bed/ward tidak boleh dilewati lewat edit bebas:
        // okupansi, riwayat, dan validasi bed hanya berlaku di
        // VisitService::transfer() (#11).
        abort_if(
            array_key_exists('ward_id', $data) || array_key_exists('bed_id', $data),
            422,
            'Pindahkan bed/ward kunjungan melalui POST /visits/{visit}/transfer.',
        );

        // Status lain (mis. batal) juga punya gerbang sendiri (bed dibebaskan,
        // tagihan terkunci diperiksa) — tidak boleh diubah lewat edit bebas.
        abort_if(
            array_key_exists('status', $data),
            422,
            'Ubah status kunjungan melalui gerbang khusus (mis. DELETE /visits/{visit} untuk batal, POST /visits/{visit}/discharge untuk pulang).',
        );

        $visit = $service->updateDetails($visit, $data, $request->user());

        return new VisitResource($visit);
    }

    public function destroy(Request $request, Visit $visit, VisitService $service): JsonResponse
    {
        // Bukan hard delete: lewat VisitService::cancel() agar bed dibebaskan
        // dan gerbang tagihan terkunci tetap berlaku (konsisten dgn store/transfer/discharge).
        $service->cancel($visit, $request->user());

        return response()->json(null, 204);
    }

    /** Gerbang mutasi antar bed (#11). */
    public function transfer(Request $request, Visit $visit, VisitService $service): JsonResponse
    {
        $data = $request->validate([
            'target_bed_id' => ['required', 'integer', 'exists:beds,id'],
            'notes' => ['nullable', 'string'],
        ]);

        $transfer = $service->transfer($visit, (int) $data['target_bed_id'], $request->user(), $data['notes'] ?? null);

        return response()->json([
            'data' => [
                'id' => $transfer->id,
                'visit_id' => $transfer->visit_id,
                'ward_from_id' => $transfer->ward_from_id,
                'bed_from_id' => $transfer->bed_from_id,
                'ward_to_id' => $transfer->ward_to_id,
                'bed_to_id' => $transfer->bed_to_id,
                'transferred_at' => $transfer->transferred_at?->toIso8601String(),
            ],
        ], 201);
    }

    /** Gerbang pulang (#11): bebaskan bed + rekam discharge + akomodasi. */
    public function discharge(Request $request, Visit $visit, VisitService $service): VisitResource
    {
        $data = $request->validate([
            'final_outcome' => ['required', 'string', 'max:255'],
            // Skema patient_discharge_records.discharge_method NOT NULL.
            'discharge_method' => ['required', 'string', 'max:255'],
            'follow_up_notes' => ['nullable', 'string'],
        ]);

        $visit = $service->discharge(
            $visit,
            $data['final_outcome'],
            $request->user(),
            $data['discharge_method'] ?? null,
            $data['follow_up_notes'] ?? null,
        );

        return new VisitResource($visit);
    }

    /** Final pelayanan terpisah dari final RME dan discharge. */
    public function finalizeService(Request $request, Visit $visit, VisitFinalizationService $service): VisitResource
    {
        return new VisitResource($service->finalize($visit, $request->user()));
    }
}
