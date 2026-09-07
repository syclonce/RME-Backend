<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPatientNutritionProblem\Http\Requests\StorePatientNutritionProblemRequest;
use Modules\MedicalRecordPatientNutritionProblem\Http\Requests\UpdatePatientNutritionProblemRequest;
use Modules\MedicalRecordPatientNutritionProblem\Http\Resources\PatientNutritionProblemResource;
use Modules\MedicalRecordPatientNutritionProblem\Models\PatientNutritionProblem;
use Modules\MedicalRecordPatientNutritionProblem\Services\PatientNutritionProblemService;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class PatientNutritionProblemController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = PatientNutritionProblem::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PatientNutritionProblemResource::collection($query->latest('identified_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientNutritionProblemRequest $request, PatientNutritionProblemService $service)
    {
        $record = $service->create($request->validated(), $request->user());

        return (new PatientNutritionProblemResource($record))->response()->setStatusCode(201);
    }

    public function show(PatientNutritionProblem $record): PatientNutritionProblemResource
    {
        return new PatientNutritionProblemResource($record);
    }

    public function update(UpdatePatientNutritionProblemRequest $request, PatientNutritionProblem $record, PatientNutritionProblemService $service): PatientNutritionProblemResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        return new PatientNutritionProblemResource(
            $service->transition($record, $request->validated()['status'], $request->user())
        );
    }
}
