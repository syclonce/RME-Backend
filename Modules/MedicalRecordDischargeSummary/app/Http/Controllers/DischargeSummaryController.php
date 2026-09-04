<?php

namespace Modules\MedicalRecordDischargeSummary\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordDischargeSummary\Http\Requests\StoreDischargeSummaryRequest;
use Modules\MedicalRecordDischargeSummary\Http\Resources\DischargeSummaryResource;
use Modules\MedicalRecordDischargeSummary\Models\DischargeSummary;

class DischargeSummaryController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = DischargeSummary::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DischargeSummaryResource::collection($query->latest('authored_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Discharge summaries are a legal medical record - append-only, no update/delete.
     * Corrections belong in a new summary, not an edit of history.
     */
    public function store(StoreDischargeSummaryRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['authored_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $summary = DischargeSummary::create($data);

        return (new DischargeSummaryResource($summary))->response()->setStatusCode(201);
    }

    public function show(DischargeSummary $discharge_summary): DischargeSummaryResource
    {
        return new DischargeSummaryResource($discharge_summary);
    }
}
