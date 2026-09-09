<?php

namespace Modules\LayananLabResult\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabResult\Http\Requests\StoreLabResultRequest;
use Modules\LayananLabResult\Http\Resources\LabResultResource;
use Modules\LayananLabResult\Models\LabResult;
use Modules\LayananLabResult\Services\LabResultService;

class LabResultController extends Controller
{
    public function index(Request $request)
    {
        $query = LabResult::query();

        if ($request->filled('lab_order_id')) {
            $query->where('lab_order_id', $request->integer('lab_order_id'));
        }

        return LabResultResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    /**
     * Sebelumnya siapa pun yang login bisa menulis hasil lab tanpa gerbang apa pun
     * (StoreLabResultRequest::authorize() selalu true, route hanya auth:sanctum).
     * Legacy SIMGOS2 memisahkan privilege input hasil (110402) dari lihat hasil
     * (110502) - lihat HasilLabResource.php:23,58,71. Di sini kita tidak menambah
     * privilege terpisah (RoutePermissionGate + authenticated_any sudah cukup
     * untuk cakupan saat ini), tapi menutup dua lubang yang sudah terverifikasi:
     * (1) hasil tidak boleh masuk ke kunjungan yang RME-nya sudah final -
     *     MedicalRecordGate::assertWritable() adalah gerbang tunggal untuk itu,
     *     dipakai modul lain lewat visit_id (lihat LabOrderService::create()).
     * (2) hasil tidak boleh dicatat untuk order yang statusnya sudah final
     *     (completed/cancelled) - order 'cancelled' secara definisi tidak akan
     *     pernah menghasilkan hasil yang sah.
     */
    public function store(StoreLabResultRequest $request, MedicalRecordGate $medicalRecordGate)
    {
        $data = $request->validated();

        $order = LabOrder::findOrFail($data['lab_order_id']);

        $medicalRecordGate->assertWritable((int) $order->visit_id, $request->user());

        abort_if(
            in_array($order->status, ['completed', 'cancelled'], true),
            422,
            "Order lab berstatus {$order->status}; hasil tidak dapat dicatat lagi.",
        );

        $data['recorded_at'] ??= now();
        $data['recorded_by'] = $request->user()->id;

        // Status tidak diterima dari klien: hasil selalu lahir 'final' (default
        // kolomnya), dan perpindahan sesudahnya hanya lewat endpoint transisi.
        // Tanpa ini klien dapat menyuntik 'cancelled' saat mencatat hasil.
        unset($data['status']);

        $result = LabResult::create($data);

        return (new LabResultResource($result))->response()->setStatusCode(201);
    }

    public function show(LabResult $lab_result): LabResultResource
    {
        return new LabResultResource($lab_result);
    }

    /**
     * Pindahkan status hasil lab. Endpoint tersendiri, bukan PUT generik, supaya
     * transisi tidak bisa terjadi sebagai efek samping penyuntingan data.
     */
    public function transition(Request $request, LabResult $lab_result, LabResultService $service): LabResultResource
    {
        $validated = $request->validate([
            'status' => ['required', 'string'],
        ]);

        return new LabResultResource($service->transition($lab_result, $validated['status'], $request->user()));
    }
}
