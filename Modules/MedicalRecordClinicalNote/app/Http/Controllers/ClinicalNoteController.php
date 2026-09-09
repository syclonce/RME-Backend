<?php

namespace Modules\MedicalRecordClinicalNote\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;
use Modules\MedicalRecordClinicalNote\Http\Requests\StoreClinicalNoteRequest;
use Modules\MedicalRecordClinicalNote\Http\Resources\ClinicalNoteResource;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;

class ClinicalNoteController extends Controller
{
    use ResolvesActingEmployee;

    public function index(Request $request)
    {
        $query = ClinicalNote::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ClinicalNoteResource::collection($query->latest('recorded_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Clinical notes are a legal medical record - append-only, no update/delete.
     * Corrections belong in a new note, not an edit of history.
     */
    public function store(StoreClinicalNoteRequest $request, MedicalRecordGate $medicalRecordGate)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'author_id');
        $medicalRecordGate->assertWritable((int) $data['visit_id'], $request->user());
        $data['recorded_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $note = ClinicalNote::create($data);

        return (new ClinicalNoteResource($note))->response()->setStatusCode(201);
    }

    public function show(ClinicalNote $clinical_note): ClinicalNoteResource
    {
        return new ClinicalNoteResource($clinical_note);
    }
}
