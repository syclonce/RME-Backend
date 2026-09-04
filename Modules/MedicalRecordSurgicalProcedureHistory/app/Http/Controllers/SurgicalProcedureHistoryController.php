<?php

namespace Modules\MedicalRecordSurgicalProcedureHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordSurgicalProcedureHistory\Http\Requests\StoreSurgicalProcedureHistoryRequest;
use Modules\MedicalRecordSurgicalProcedureHistory\Http\Resources\SurgicalProcedureHistoryResource;
use Modules\MedicalRecordSurgicalProcedureHistory\Models\SurgicalProcedureHistory;

class SurgicalProcedureHistoryController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = SurgicalProcedureHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return SurgicalProcedureHistoryResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSurgicalProcedureHistoryRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['created_by'] = $request->user()->id;

        $record = SurgicalProcedureHistory::create($data);

        return (new SurgicalProcedureHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(SurgicalProcedureHistory $record): SurgicalProcedureHistoryResource
    {
        return new SurgicalProcedureHistoryResource($record);
    }
}
