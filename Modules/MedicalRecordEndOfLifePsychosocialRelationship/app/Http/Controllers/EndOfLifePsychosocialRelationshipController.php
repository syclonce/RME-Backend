<?php

namespace Modules\MedicalRecordEndOfLifePsychosocialRelationship\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordEndOfLifePsychosocialRelationship\Http\Requests\StoreEndOfLifePsychosocialRelationshipRequest;
use Modules\MedicalRecordEndOfLifePsychosocialRelationship\Http\Requests\UpdateEndOfLifePsychosocialRelationshipRequest;
use Modules\MedicalRecordEndOfLifePsychosocialRelationship\Http\Resources\EndOfLifePsychosocialRelationshipResource;
use Modules\MedicalRecordEndOfLifePsychosocialRelationship\Models\EndOfLifePsychosocialRelationship;

class EndOfLifePsychosocialRelationshipController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = EndOfLifePsychosocialRelationship::query();

        return EndOfLifePsychosocialRelationshipResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEndOfLifePsychosocialRelationshipRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'assessed_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $record = EndOfLifePsychosocialRelationship::create($data);

        return (new EndOfLifePsychosocialRelationshipResource($record))->response()->setStatusCode(201);
    }

    public function show(EndOfLifePsychosocialRelationship $record): EndOfLifePsychosocialRelationshipResource
    {
        return new EndOfLifePsychosocialRelationshipResource($record);
    }

    public function update(UpdateEndOfLifePsychosocialRelationshipRequest $request, EndOfLifePsychosocialRelationship $record): EndOfLifePsychosocialRelationshipResource
    {
        $record->update($request->validated());

        return new EndOfLifePsychosocialRelationshipResource($record);
    }

    public function destroy(EndOfLifePsychosocialRelationship $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
