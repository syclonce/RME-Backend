<?php

namespace Modules\MedicalRecordBloodTransfusion\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBloodTransfusion\Http\Requests\StoreBloodTransfusionRequest;
use Modules\MedicalRecordBloodTransfusion\Http\Requests\UpdateBloodTransfusionRequest;
use Modules\MedicalRecordBloodTransfusion\Http\Resources\BloodTransfusionResource;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\MedicalRecordBloodTransfusion\Services\BloodTransfusionService;

class BloodTransfusionController extends Controller
{
    public function index(Request $request)
    {
        $query = BloodTransfusion::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return BloodTransfusionResource::collection($query->latest('started_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBloodTransfusionRequest $request, BloodTransfusionService $service)
    {
        $transfusion = $service->create($request->validated(), $request->user());

        return (new BloodTransfusionResource($transfusion))->response()->setStatusCode(201);
    }

    public function show(BloodTransfusion $blood_transfusion): BloodTransfusionResource
    {
        return new BloodTransfusionResource($blood_transfusion);
    }

    /**
     * Hanya transisi status (workflow) - detail klinis transfusi yang sudah
     * dicatat saat create tidak lagi bisa diubah lewat endpoint ini.
     */
    public function update(UpdateBloodTransfusionRequest $request, BloodTransfusion $blood_transfusion, BloodTransfusionService $service): BloodTransfusionResource
    {
        $validated = $request->validated();

        return new BloodTransfusionResource($service->transition(
            $blood_transfusion,
            $validated['status'],
            $request->user(),
            $validated,
        ));
    }
}
