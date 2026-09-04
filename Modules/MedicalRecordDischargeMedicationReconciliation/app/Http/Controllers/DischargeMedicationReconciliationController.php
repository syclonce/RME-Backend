<?php

namespace Modules\MedicalRecordDischargeMedicationReconciliation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDischargeMedicationReconciliation\Http\Requests\StoreDischargeMedicationReconciliationRequest;
use Modules\MedicalRecordDischargeMedicationReconciliation\Http\Requests\UpdateDischargeMedicationReconciliationRequest;
use Modules\MedicalRecordDischargeMedicationReconciliation\Http\Resources\DischargeMedicationReconciliationResource;
use Modules\MedicalRecordDischargeMedicationReconciliation\Models\DischargeMedicationReconciliation;
use Modules\MedicalRecordDischargeMedicationReconciliation\Services\DischargeMedicationReconciliationService;

class DischargeMedicationReconciliationController extends Controller
{
    public function index(Request $request)
    {
        $query = DischargeMedicationReconciliation::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DischargeMedicationReconciliationResource::collection($query->latest('reconciled_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDischargeMedicationReconciliationRequest $request, DischargeMedicationReconciliationService $service)
    {
        $record = $service->create($request->validated(), $request->user());

        return (new DischargeMedicationReconciliationResource($record))->response()->setStatusCode(201);
    }

    public function show(DischargeMedicationReconciliation $record): DischargeMedicationReconciliationResource
    {
        return new DischargeMedicationReconciliationResource($record);
    }

    public function update(UpdateDischargeMedicationReconciliationRequest $request, DischargeMedicationReconciliation $record, DischargeMedicationReconciliationService $service): DischargeMedicationReconciliationResource
    {
        return new DischargeMedicationReconciliationResource(
            $service->transition($record, $request->validated()['status'], $request->user())
        );
    }
}
