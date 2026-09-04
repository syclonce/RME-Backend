<?php

namespace Modules\MedicalRecordFibroscanResult\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordFibroscanResult\Http\Requests\StoreFibroscanResultRequest;
use Modules\MedicalRecordFibroscanResult\Http\Requests\UpdateFibroscanResultRequest;
use Modules\MedicalRecordFibroscanResult\Http\Resources\FibroscanResultResource;
use Modules\MedicalRecordFibroscanResult\Models\FibroscanResult;

class FibroscanResultController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = FibroscanResult::query();

        return FibroscanResultResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreFibroscanResultRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'examined_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $record = FibroscanResult::create($data);

        return (new FibroscanResultResource($record))->response()->setStatusCode(201);
    }

    public function show(FibroscanResult $record): FibroscanResultResource
    {
        return new FibroscanResultResource($record);
    }

    public function update(UpdateFibroscanResultRequest $request, FibroscanResult $record): FibroscanResultResource
    {
        $record->update($request->validated());

        return new FibroscanResultResource($record);
    }

    public function destroy(FibroscanResult $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
