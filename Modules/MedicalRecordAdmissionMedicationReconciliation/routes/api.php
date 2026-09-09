<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordAdmissionMedicationReconciliation\Http\Controllers\AdmissionMedicationReconciliationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('admission-med-reconciliations', AdmissionMedicationReconciliationController::class)->only(['index', 'show'])->parameters(['admission-med-reconciliations' => 'record']);

    Route::apiResource('admission-med-reconciliations', AdmissionMedicationReconciliationController::class)->only(['store', 'update'])->parameters(['admission-med-reconciliations' => 'record']);
});
