<?php

namespace Modules\MedicalRecordNursingIndicatorImplementation\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingIndicatorImplementation\Http\Requests\StoreNursingIndicatorImplementationRequest;
use Modules\MedicalRecordNursingIndicatorImplementation\Http\Resources\NursingIndicatorImplementationResource;
use Modules\MedicalRecordNursingIndicatorImplementation\Models\NursingIndicatorImplementation;

class NursingIndicatorImplementationController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = NursingIndicatorImplementation::query();

        return NursingIndicatorImplementationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingIndicatorImplementationRequest $request)
    {
        $data = $request->validated();
        $data['recorded_at'] ??= now();
        $data = $this->fillActingEmployee($request, $data, 'recorded_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $record = NursingIndicatorImplementation::create($data);

        return (new NursingIndicatorImplementationResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingIndicatorImplementation $record): NursingIndicatorImplementationResource
    {
        return new NursingIndicatorImplementationResource($record);
    }

    public function destroy(NursingIndicatorImplementation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
