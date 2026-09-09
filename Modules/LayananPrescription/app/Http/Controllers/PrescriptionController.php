<?php

namespace Modules\LayananPrescription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPrescription\Http\Requests\StorePrescriptionRequest;
use Modules\LayananPrescription\Http\Resources\PrescriptionResource;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescription\Services\PrescriptionService;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Prescription::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PrescriptionResource::collection($query->latest('prescribed_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Prescriptions are a legal medical record - append-only, no update/delete,
     * same as ClinicalNote. Corrections belong in a new prescription.
     *
     * Gerbang MedicalRecordGate + BillingGate (kunci kasir) dipindahkan ke
     * PrescriptionService::create() supaya jalur lain yang membuat resep
     * lewat service ini tetap tunduk pada gerbang yang sama.
     */
    public function store(StorePrescriptionRequest $request, PrescriptionService $service)
    {
        $prescription = $service->create($request->validated(), $request->user());

        return (new PrescriptionResource($prescription))->response()->setStatusCode(201);
    }

    public function show(Prescription $prescription): PrescriptionResource
    {
        return new PrescriptionResource($prescription->load('items'));
    }

    /**
     * Batalkan resep. Hanya resep berstatus 'active' yang bisa dibatalkan -
     * lihat PrescriptionService untuk alasan 'dispensed' tidak pernah
     * disediakan sebagai status asal yang diizinkan (obat sudah keluar,
     * stok sudah terpotong - pembatalan harus lewat retur farmasi).
     */
    public function cancel(Request $request, Prescription $prescription, PrescriptionService $service): PrescriptionResource
    {
        return new PrescriptionResource($service->cancel($prescription, $request->user()));
    }
}
