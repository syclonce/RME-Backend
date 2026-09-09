<?php

namespace Modules\MedicalRecordPlanAndTherapy\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPlanAndTherapy\Http\Requests\StorePlanAndTherapyRequest;
use Modules\MedicalRecordPlanAndTherapy\Http\Requests\UpdatePlanAndTherapyRequest;
use Modules\MedicalRecordPlanAndTherapy\Http\Resources\PlanAndTherapyResource;
use Modules\MedicalRecordPlanAndTherapy\Models\PlanAndTherapy;
use Modules\MedicalRecordPlanAndTherapy\Services\PlanAndTherapyService;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class PlanAndTherapyController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = PlanAndTherapy::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PlanAndTherapyResource::collection($query->latest('ordered_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePlanAndTherapyRequest $request, PlanAndTherapyService $service)
    {
        $record = $service->create($request->validated(), $request->user());

        return (new PlanAndTherapyResource($record))->response()->setStatusCode(201);
    }

    public function show(PlanAndTherapy $record): PlanAndTherapyResource
    {
        return new PlanAndTherapyResource($record);
    }

    public function update(UpdatePlanAndTherapyRequest $request, PlanAndTherapy $record, PlanAndTherapyService $service): PlanAndTherapyResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        return new PlanAndTherapyResource(
            $service->transition($record, $request->validated()['status'], $request->user())
        );
    }
}
