<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatient\Http\Controllers\PatientController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('patients/search', [PatientController::class, 'search']);

    Route::apiResource('patients', PatientController::class)->only(['index', 'show']);

    Route::apiResource('patients', PatientController::class)->only(['store', 'update', 'destroy']);
});
