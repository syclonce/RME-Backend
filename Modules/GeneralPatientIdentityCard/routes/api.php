<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientIdentityCard\Http\Controllers\PatientIdentityCardController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patientidentitycards', PatientIdentityCardController::class)->names('generalpatientidentitycard.patientidentitycards')->only(['index', 'show']);

    Route::apiResource('patientidentitycards', PatientIdentityCardController::class)->names('generalpatientidentitycard.patientidentitycards')->only(['store', 'update', 'destroy']);
});
