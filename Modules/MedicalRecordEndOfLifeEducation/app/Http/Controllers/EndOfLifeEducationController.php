<?php

namespace Modules\MedicalRecordEndOfLifeEducation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordEndOfLifeEducation\Http\Requests\StoreEndOfLifeEducationRequest;
use Modules\MedicalRecordEndOfLifeEducation\Http\Requests\UpdateEndOfLifeEducationRequest;
use Modules\MedicalRecordEndOfLifeEducation\Http\Resources\EndOfLifeEducationResource;
use Modules\MedicalRecordEndOfLifeEducation\Models\EndOfLifeEducation;

class EndOfLifeEducationController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = EndOfLifeEducation::query();

        return EndOfLifeEducationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEndOfLifeEducationRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $record = EndOfLifeEducation::create($data);

        return (new EndOfLifeEducationResource($record))->response()->setStatusCode(201);
    }

    public function show(EndOfLifeEducation $record): EndOfLifeEducationResource
    {
        return new EndOfLifeEducationResource($record);
    }

    public function update(UpdateEndOfLifeEducationRequest $request, EndOfLifeEducation $record): EndOfLifeEducationResource
    {
        $record->update($request->validated());

        return new EndOfLifeEducationResource($record);
    }

    public function destroy(EndOfLifeEducation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
