<?php

namespace Modules\MedicalRecordTriage\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordTriage\Http\Requests\StoreTriageRequest;
use Modules\MedicalRecordTriage\Http\Resources\TriageResource;
use Modules\MedicalRecordTriage\Models\Triage;

class TriageController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = Triage::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return TriageResource::collection($query->latest('assessed_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Triage assessments are a legal medical record - append-only, no update/delete.
     * Corrections belong in a new assessment, not an edit of history.
     */
    public function store(StoreTriageRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['assessed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $triage = Triage::create($data);

        return (new TriageResource($triage))->response()->setStatusCode(201);
    }

    public function show(Triage $triage): TriageResource
    {
        return new TriageResource($triage);
    }
}
