<?php

namespace Modules\MedicalRecordInpatientCarePlan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordInpatientCarePlan\Http\Requests\StoreInpatientCarePlanRequest;
use Modules\MedicalRecordInpatientCarePlan\Http\Requests\UpdateInpatientCarePlanRequest;
use Modules\MedicalRecordInpatientCarePlan\Http\Resources\InpatientCarePlanResource;
use Modules\MedicalRecordInpatientCarePlan\Models\InpatientCarePlan;
use Modules\MedicalRecordInpatientCarePlan\Services\InpatientCarePlanService;

class InpatientCarePlanController extends Controller
{
    public function index(Request $request)
    {
        $query = InpatientCarePlan::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return InpatientCarePlanResource::collection($query->latest('planned_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInpatientCarePlanRequest $request, InpatientCarePlanService $service)
    {
        $record = $service->create($request->validated(), $request->user());

        return (new InpatientCarePlanResource($record))->response()->setStatusCode(201);
    }

    public function show(InpatientCarePlan $record): InpatientCarePlanResource
    {
        return new InpatientCarePlanResource($record);
    }

    public function update(UpdateInpatientCarePlanRequest $request, InpatientCarePlan $record, InpatientCarePlanService $service): InpatientCarePlanResource
    {
        return new InpatientCarePlanResource(
            $service->transition($record, $request->validated()['status'], $request->user())
        );
    }
}
