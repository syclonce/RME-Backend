<?php

namespace Modules\MedicalRecordTransferMedicationReconciliation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordTransferMedicationReconciliation\Http\Requests\StoreTransferMedicationReconciliationRequest;
use Modules\MedicalRecordTransferMedicationReconciliation\Http\Requests\UpdateTransferMedicationReconciliationRequest;
use Modules\MedicalRecordTransferMedicationReconciliation\Http\Resources\TransferMedicationReconciliationResource;
use Modules\MedicalRecordTransferMedicationReconciliation\Models\TransferMedicationReconciliation;
use Modules\MedicalRecordTransferMedicationReconciliation\Services\TransferMedicationReconciliationService;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class TransferMedicationReconciliationController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = TransferMedicationReconciliation::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return TransferMedicationReconciliationResource::collection($query->latest('reconciled_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTransferMedicationReconciliationRequest $request, TransferMedicationReconciliationService $service)
    {
        $record = $service->create($request->validated(), $request->user());

        return (new TransferMedicationReconciliationResource($record))->response()->setStatusCode(201);
    }

    public function show(TransferMedicationReconciliation $record): TransferMedicationReconciliationResource
    {
        return new TransferMedicationReconciliationResource($record);
    }

    public function update(UpdateTransferMedicationReconciliationRequest $request, TransferMedicationReconciliation $record, TransferMedicationReconciliationService $service): TransferMedicationReconciliationResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        return new TransferMedicationReconciliationResource(
            $service->transition($record, $request->validated()['status'], $request->user())
        );
    }
}
