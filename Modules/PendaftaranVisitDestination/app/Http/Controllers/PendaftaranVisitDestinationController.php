<?php

namespace Modules\PendaftaranVisitDestination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\PendaftaranVisitDestination\Http\Requests\StoreVisitDestinationRequest;
use Modules\PendaftaranVisitDestination\Http\Requests\UpdateVisitDestinationRequest;
use Modules\PendaftaranVisitDestination\Http\Resources\VisitDestinationResource;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;
use Modules\PendaftaranWardQueue\Services\WardQueueService;

class PendaftaranVisitDestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = VisitDestination::query()->with(['ward', 'doctor']);

        if ($request->filled('registration_id')) {
            $query->where('registration_id', $request->integer('registration_id'));
        }

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        // Antrean poli = tujuan yang belum diterima. Disediakan sebagai filter
        // tersendiri karena inilah pemakaian utamanya di layar petugas ruangan.
        if ($request->boolean('pending_only')) {
            $query->pending();
        }

        return VisitDestinationResource::collection(
            $query->latest('id')->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreVisitDestinationRequest $request, WardQueueService $queue)
    {
        $destination = VisitDestination::create([
            ...$request->validated(),
            'created_by' => $request->user()?->id,
        ]);

        // Port trigger `onAfterInsertTujuanPasien` simgos2: begitu tujuan dibuat,
        // pasien langsung masuk antrean ruangan. Inilah yang membuat antrean bisa
        // ada sebelum pasien diterima — dan yang memasok Antrean Online BPJS.
        $queue->enqueue($destination->ward_id, $destination->registration_id);

        return new VisitDestinationResource($destination->load(['ward', 'doctor']));
    }

    public function show(VisitDestination $pendaftaranvisitdestination)
    {
        return new VisitDestinationResource($pendaftaranvisitdestination->load(['ward', 'doctor']));
    }

    public function update(UpdateVisitDestinationRequest $request, VisitDestination $pendaftaranvisitdestination)
    {
        // Aturan legacy: tujuan yang sudah diterima tidak boleh diubah ruangannya.
        // Di legacy pemindahan pasien antar-ruangan setelah diterima dilakukan
        // lewat Mutasi/Konsul yang menerbitkan kunjungan baru — bukan dengan
        // menimpa tujuan, karena itu akan menghapus jejak ruangan asal.
        if (
            $pendaftaranvisitdestination->status === VisitDestination::STATUS_ACCEPTED
            && $request->filled('ward_id')
            && $request->integer('ward_id') !== $pendaftaranvisitdestination->ward_id
        ) {
            return response()->json([
                'message' => 'Pasien sudah diterima di ruangan ini. Gunakan mutasi atau konsul untuk memindahkan pasien.',
            ], 422);
        }

        $pendaftaranvisitdestination->update($request->validated());

        return new VisitDestinationResource($pendaftaranvisitdestination->load(['ward', 'doctor']));
    }

    /**
     * Tujuan tidak dihapus, melainkan dibatalkan — mengikuti pola legacy yang
     * mencatat pembatalan sebagai keadaan, bukan menghilangkan barisnya.
     */
    public function destroy(VisitDestination $pendaftaranvisitdestination): JsonResponse
    {
        if ($pendaftaranvisitdestination->status === VisitDestination::STATUS_ACCEPTED) {
            return response()->json([
                'message' => 'Tujuan yang sudah diterima tidak dapat dibatalkan. Batalkan kunjungannya terlebih dahulu.',
            ], 422);
        }

        $pendaftaranvisitdestination->update(['status' => VisitDestination::STATUS_CANCELLED]);

        return response()->json(['message' => 'Tujuan pasien dibatalkan.']);
    }
}
