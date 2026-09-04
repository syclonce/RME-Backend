<?php

namespace Modules\LayananMedicalSupplyUsage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananMedicalSupplyUsage\Http\Requests\StoreMedicalSupplyUsageRequest;
use Modules\LayananMedicalSupplyUsage\Http\Requests\UpdateMedicalSupplyUsageRequest;
use Modules\LayananMedicalSupplyUsage\Http\Resources\MedicalSupplyUsageResource;
use Modules\LayananMedicalSupplyUsage\Models\MedicalSupplyUsage;
use Modules\LayananMedicalSupplyUsage\Services\MedicalSupplyUsageService;

class MedicalSupplyUsageController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalSupplyUsage::query();

        return MedicalSupplyUsageResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicalSupplyUsageRequest $request, MedicalSupplyUsageService $service)
    {
        $supply_usage = $service->create($request->validated(), $request->user());

        return (new MedicalSupplyUsageResource($supply_usage))->response()->setStatusCode(201);
    }

    public function show(MedicalSupplyUsage $supply_usage): MedicalSupplyUsageResource
    {
        return new MedicalSupplyUsageResource($supply_usage);
    }

    /**
     * Hanya status yang bisa diubah lewat endpoint ini (transisi workflow) -
     * sama seperti LabOrder.
     */
    public function update(UpdateMedicalSupplyUsageRequest $request, MedicalSupplyUsage $supply_usage, MedicalSupplyUsageService $service): MedicalSupplyUsageResource
    {
        return new MedicalSupplyUsageResource($service->transition(
            $supply_usage,
            $request->validated('status'),
            $request->user(),
        ));
    }
}
