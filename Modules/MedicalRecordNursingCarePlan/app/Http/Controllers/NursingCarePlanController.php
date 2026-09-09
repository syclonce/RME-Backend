<?php

namespace Modules\MedicalRecordNursingCarePlan\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingCarePlan\Http\Requests\StoreNursingCarePlanRequest;
use Modules\MedicalRecordNursingCarePlan\Http\Requests\UpdateNursingCarePlanRequest;
use Modules\MedicalRecordNursingCarePlan\Http\Resources\NursingCarePlanResource;
use Modules\MedicalRecordNursingCarePlan\Models\NursingCarePlan;

class NursingCarePlanController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = NursingCarePlan::query();

        return NursingCarePlanResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingCarePlanRequest $request)
    {
        $data = $request->validated();
        $data['recorded_at'] ??= now();
        $data = $this->fillActingEmployee($request, $data, 'recorded_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['status'] ??= 'active';

        $record = NursingCarePlan::create($data);

        return (new NursingCarePlanResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingCarePlan $record): NursingCarePlanResource
    {
        return new NursingCarePlanResource($record);
    }

    public function update(UpdateNursingCarePlanRequest $request, NursingCarePlan $record): NursingCarePlanResource
    {
        $record->update($request->validated());

        return new NursingCarePlanResource($record);
    }

    public function destroy(NursingCarePlan $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
