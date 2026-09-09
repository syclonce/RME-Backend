<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordCppt\Http\Controllers\CpptEntryController;
use Modules\MedicalRecordCppt\Http\Controllers\CpptVerificationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // Append-only: tanpa update/destroy (seperti VitalSign).
    Route::apiResource('cppt-entries', CpptEntryController::class)
        ->only(['index', 'show', 'store'])
        ->parameters(['cppt-entries' => 'cppt_entry']);

    Route::apiResource('cppt-verifications', CpptVerificationController::class)
        ->only(['index', 'show', 'store'])
        ->parameters(['cppt-verifications' => 'cppt_verification']);
});
