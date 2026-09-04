<?php

namespace Modules\LayananRadiologyOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananRadiologyOrder\Http\Requests\StoreRadiologyOrderRequest;
use Modules\LayananRadiologyOrder\Http\Requests\UpdateRadiologyOrderRequest;
use Modules\LayananRadiologyOrder\Http\Resources\RadiologyOrderResource;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;
use Modules\LayananRadiologyOrder\Services\RadiologyOrderService;

class RadiologyOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyOrder::query();

        // Sama seperti modul klinis lain: order radiologi disaring ke kunjungan
        // yang sedang dilayani, supaya daftar tidak bercampur antar pasien.
        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        // Filter status & modality diserap dari ImagingOrderController::index().
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('modality')) {
            $query->where('modality', $request->input('modality'));
        }

        return RadiologyOrderResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyOrderRequest $request, RadiologyOrderService $service)
    {
        $order = $service->create($request->validated(), $request->user());

        return (new RadiologyOrderResource($order))->response()->setStatusCode(201);
    }

    public function show(RadiologyOrder $rad_order): RadiologyOrderResource
    {
        return new RadiologyOrderResource($rad_order);
    }

    /**
     * Hanya field status yang bisa diubah lewat sini (transisi state machine) —
     * detail order klinis (visit/pasien/dokter/catatan) tidak lagi bisa disunting
     * bebas, sama seperti LabOrderController::update().
     */
    public function update(UpdateRadiologyOrderRequest $request, RadiologyOrder $rad_order, RadiologyOrderService $service): RadiologyOrderResource
    {
        return new RadiologyOrderResource($service->transition(
            $rad_order,
            $request->validated('status'),
            $request->user(),
        ));
    }

    /**
     * Gerbang penjadwalan eksplisit (diserap dari ImagingOrderController::schedule()),
     * termasuk jadwal ulang. Bukan edit bebas — sama seperti pola transfer/discharge
     * di VisitController.
     */
    public function schedule(Request $request, RadiologyOrder $rad_order, RadiologyOrderService $service): RadiologyOrderResource
    {
        $data = $request->validate([
            'scheduled_at' => ['required', 'date'],
        ]);

        return new RadiologyOrderResource($service->schedule($rad_order, $data['scheduled_at'], $request->user()));
    }

    /** Gerbang pembatalan eksplisit (diserap dari ImagingOrderController::cancel()). */
    public function cancel(Request $request, RadiologyOrder $rad_order, RadiologyOrderService $service): RadiologyOrderResource
    {
        return new RadiologyOrderResource($service->cancel($rad_order, $request->user()));
    }
}
