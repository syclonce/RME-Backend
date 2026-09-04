<?php

namespace Modules\LayananRadiologyResult\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;
use Modules\LayananRadiologyOrder\Services\RadiologyOrderService;
use Modules\LayananRadiologyResult\Http\Requests\StoreRadiologyResultRequest;
use Modules\LayananRadiologyResult\Http\Requests\UpdateRadiologyResultRequest;
use Modules\LayananRadiologyResult\Http\Resources\RadiologyResultResource;
use Modules\LayananRadiologyResult\Models\RadiologyResult;

class RadiologyResultController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyResult::query();

        return RadiologyResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Sama seperti LabResultController::store() - sebelumnya route ini hanya
     * dijaga auth:sanctum, dan StoreRadiologyResultRequest::authorize() selalu
     * true, jadi siapa pun yang login bisa menulis hasil radiologi ke kunjungan
     * mana pun. Legacy SIMGOS2 memisahkan privilege input hasil dari privilege
     * lihat hasil (lihat catatan di LabResultController). Menutup dua lubang:
     * (1) hasil tidak boleh masuk ke kunjungan yang RME-nya sudah final
     *     (MedicalRecordGate::assertWritable(), pola yang sama dipakai
     *     LabOrderService dan ClinicalNoteController).
     * (2) hasil tidak boleh dicatat untuk radiology_order yang sudah
     *     completed/cancelled - order 'cancelled' tidak pernah punya hasil sah.
     *
     * Auto-complete order (diserap dari ImagingStudyService::record(), keputusan
     * pemilik repo 2026-09-04): saat hasil dicatat dengan status 'final', order
     * yang belum terminal ikut ditransisikan ke 'completed' lewat
     * RadiologyOrderService::transition() — bukan update kolom langsung, supaya
     * tetap lewat satu jalur gerbang state machine yang sama dengan endpoint lain.
     * Hasil berstatus 'pending' TIDAK memicu auto-complete: hasil masih berupa
     * draf, order belum benar-benar selesai (beda dengan ImagingStudy lama yang
     * tidak mengenal status draf/final terpisah untuk studinya).
     */
    public function store(StoreRadiologyResultRequest $request, MedicalRecordGate $medicalRecordGate, RadiologyOrderService $orderService)
    {
        $data = $request->validated();

        $order = RadiologyOrder::findOrFail($data['radiology_order_id']);

        $medicalRecordGate->assertWritable((int) $order->visit_id, $request->user());

        abort_if(
            in_array($order->status, ['completed', 'cancelled'], true),
            422,
            "Order radiologi berstatus {$order->status}; hasil tidak dapat dicatat lagi.",
        );

        $data['status'] = $data['status'] ?? 'pending';
        $rad_result = RadiologyResult::create($data);

        if ($data['status'] === 'final' && $order->status !== 'completed') {
            $target = $order->status === 'in_progress' ? 'completed' : null;
            // pending/scheduled → in_progress → completed: order yang belum
            // in_progress dinaikkan bertahap dulu supaya TRANSITIONS tetap ditegakkan
            // (mis. pending tidak pernah lompat langsung ke completed di transition()).
            if ($target === null) {
                $order = $orderService->transition($order, 'in_progress', $request->user());
                $target = 'completed';
            }
            $orderService->transition($order, $target, $request->user());
        }

        return (new RadiologyResultResource($rad_result))->response()->setStatusCode(201);
    }

    public function show(RadiologyResult $rad_result): RadiologyResultResource
    {
        return new RadiologyResultResource($rad_result);
    }

    /**
     * update() mengubah hasil yang sudah ada (mis. koreksi findings/impression
     * sebelum final) - gerbang RME yang sama berlaku lewat order terkait supaya
     * hasil di kunjungan yang sudah final tidak bisa diam-diam diubah lagi.
     */
    public function update(UpdateRadiologyResultRequest $request, RadiologyResult $rad_result, MedicalRecordGate $medicalRecordGate): RadiologyResultResource
    {
        $order = $rad_result->radiologyOrder;
        $medicalRecordGate->assertWritable((int) $order->visit_id, $request->user());

        $rad_result->update($request->validated());

        return new RadiologyResultResource($rad_result);
    }
}
