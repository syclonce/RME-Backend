<?php

namespace Modules\MedicalRecordRiskFactor\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordRiskFactor\Http\Requests\StoreRiskFactorRequest;
use Modules\MedicalRecordRiskFactor\Http\Requests\UpdateRiskFactorRequest;
use Modules\MedicalRecordRiskFactor\Http\Resources\RiskFactorResource;
use Modules\MedicalRecordRiskFactor\Models\RiskFactor;

class RiskFactorController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = RiskFactor::query();

        return RiskFactorResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRiskFactorRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $record = RiskFactor::create($data);

        return (new RiskFactorResource($record))->response()->setStatusCode(201);
    }

    public function show(RiskFactor $record): RiskFactorResource
    {
        return new RiskFactorResource($record);
    }

    public function update(UpdateRiskFactorRequest $request, RiskFactor $record): RiskFactorResource
    {
        $record->update($request->validated());

        return new RiskFactorResource($record);
    }

    public function destroy(RiskFactor $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
