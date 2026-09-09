<?php

namespace Modules\MedicalRecordNursingCarePlanImplementation\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingCarePlanImplementation\Http\Requests\StoreNursingCarePlanImplementationRequest;
use Modules\MedicalRecordNursingCarePlanImplementation\Http\Requests\UpdateNursingCarePlanImplementationRequest;
use Modules\MedicalRecordNursingCarePlanImplementation\Http\Resources\NursingCarePlanImplementationResource;
use Modules\MedicalRecordNursingCarePlanImplementation\Models\NursingCarePlanImplementation;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class NursingCarePlanImplementationController extends Controller
{
    use GuardsMedicalRecord;

    use ResolvesActingEmployee;

    public function index(Request $request)
    {
        $query = NursingCarePlanImplementation::query();

        return NursingCarePlanImplementationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingCarePlanImplementationRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'performed_by');

        $record = NursingCarePlanImplementation::create($data);

        return (new NursingCarePlanImplementationResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingCarePlanImplementation $record): NursingCarePlanImplementationResource
    {
        return new NursingCarePlanImplementationResource($record);
    }

    public function update(UpdateNursingCarePlanImplementationRequest $request, NursingCarePlanImplementation $record): NursingCarePlanImplementationResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->update($request->validated());

        return new NursingCarePlanImplementationResource($record);
    }

    public function destroy(Request $request, NursingCarePlanImplementation $record)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->delete();

        return response()->json(null, 204);
    }
}
