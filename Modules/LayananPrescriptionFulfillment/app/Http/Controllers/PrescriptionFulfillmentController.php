<?php

namespace Modules\LayananPrescriptionFulfillment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;
use Modules\LayananPrescriptionFulfillment\Http\Requests\StorePrescriptionFulfillmentRequest;
use Modules\LayananPrescriptionFulfillment\Http\Requests\UpdatePrescriptionFulfillmentRequest;
use Modules\LayananPrescriptionFulfillment\Http\Resources\PrescriptionFulfillmentResource;
use Modules\LayananPrescriptionFulfillment\Models\PrescriptionFulfillment;
use Modules\LayananPrescription\Models\Prescription;

class PrescriptionFulfillmentController extends Controller
{
    public function index(Request $request)
    {
        $query = PrescriptionFulfillment::query();

        return PrescriptionFulfillmentResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePrescriptionFulfillmentRequest $request)
    {
        $data = $request->validated();

        // Menempel ke episode lewat prescription_id, bukan visit_id langsung.
        $prescription = Prescription::query()->findOrFail($data['prescription_id']);
        app(MedicalRecordGate::class)->assertWritable((int) $prescription->visit_id, $request->user());

        $data['status'] ??= 'served';

        $record = PrescriptionFulfillment::create($data);

        return (new PrescriptionFulfillmentResource($record))->response()->setStatusCode(201);
    }

    public function show(PrescriptionFulfillment $record): PrescriptionFulfillmentResource
    {
        return new PrescriptionFulfillmentResource($record);
    }

    public function update(UpdatePrescriptionFulfillmentRequest $request, PrescriptionFulfillment $record): PrescriptionFulfillmentResource
    {
        $record->update($request->validated());

        return new PrescriptionFulfillmentResource($record);
    }

    public function destroy(PrescriptionFulfillment $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
