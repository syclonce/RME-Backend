<?php

namespace Modules\MedicalRecordDischargePlanningRiskFactor\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordDischargePlanningRiskFactor\Http\Requests\StoreDischargePlanningRiskFactorRequest;
use Modules\MedicalRecordDischargePlanningRiskFactor\Http\Requests\UpdateDischargePlanningRiskFactorRequest;
use Modules\MedicalRecordDischargePlanningRiskFactor\Http\Resources\DischargePlanningRiskFactorResource;
use Modules\MedicalRecordDischargePlanningRiskFactor\Models\DischargePlanningRiskFactor;

class DischargePlanningRiskFactorController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = DischargePlanningRiskFactor::query();

        return DischargePlanningRiskFactorResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDischargePlanningRiskFactorRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $record = DischargePlanningRiskFactor::create($data);

        return (new DischargePlanningRiskFactorResource($record))->response()->setStatusCode(201);
    }

    public function show(DischargePlanningRiskFactor $record): DischargePlanningRiskFactorResource
    {
        return new DischargePlanningRiskFactorResource($record);
    }

    public function update(UpdateDischargePlanningRiskFactorRequest $request, DischargePlanningRiskFactor $record): DischargePlanningRiskFactorResource
    {
        $record->update($request->validated());

        return new DischargePlanningRiskFactorResource($record);
    }

    public function destroy(DischargePlanningRiskFactor $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
