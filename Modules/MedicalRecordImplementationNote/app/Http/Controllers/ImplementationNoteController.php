<?php

namespace Modules\MedicalRecordImplementationNote\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordImplementationNote\Http\Requests\StoreImplementationNoteRequest;
use Modules\MedicalRecordImplementationNote\Http\Requests\UpdateImplementationNoteRequest;
use Modules\MedicalRecordImplementationNote\Http\Resources\ImplementationNoteResource;
use Modules\MedicalRecordImplementationNote\Models\ImplementationNote;

class ImplementationNoteController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = ImplementationNote::query();

        return ImplementationNoteResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreImplementationNoteRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $record = ImplementationNote::create($data);

        return (new ImplementationNoteResource($record))->response()->setStatusCode(201);
    }

    public function show(ImplementationNote $record): ImplementationNoteResource
    {
        return new ImplementationNoteResource($record);
    }

    public function update(UpdateImplementationNoteRequest $request, ImplementationNote $record): ImplementationNoteResource
    {
        $record->update($request->validated());

        return new ImplementationNoteResource($record);
    }

    public function destroy(ImplementationNote $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
