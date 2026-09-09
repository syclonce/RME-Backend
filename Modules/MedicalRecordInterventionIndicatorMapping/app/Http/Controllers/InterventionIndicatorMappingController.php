<?php

namespace Modules\MedicalRecordInterventionIndicatorMapping\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordInterventionIndicatorMapping\Http\Requests\StoreInterventionIndicatorMappingRequest;
use Modules\MedicalRecordInterventionIndicatorMapping\Http\Requests\UpdateInterventionIndicatorMappingRequest;
use Modules\MedicalRecordInterventionIndicatorMapping\Http\Resources\InterventionIndicatorMappingResource;
use Modules\MedicalRecordInterventionIndicatorMapping\Models\InterventionIndicatorMapping;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class InterventionIndicatorMappingController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = InterventionIndicatorMapping::query();

        if ($request->filled('intervention_code')) {
            $query->where('intervention_code', $request->string('intervention_code'));
        }

        return InterventionIndicatorMappingResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreInterventionIndicatorMappingRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = InterventionIndicatorMapping::create($data);

        return (new InterventionIndicatorMappingResource($record))->response()->setStatusCode(201);
    }

    public function show(InterventionIndicatorMapping $record): InterventionIndicatorMappingResource
    {
        return new InterventionIndicatorMappingResource($record);
    }

    public function update(UpdateInterventionIndicatorMappingRequest $request, InterventionIndicatorMapping $record): InterventionIndicatorMappingResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->update($request->validated());

        return new InterventionIndicatorMappingResource($record);
    }

    public function destroy(Request $request, InterventionIndicatorMapping $record)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->delete();

        return response()->noContent();
    }
}
