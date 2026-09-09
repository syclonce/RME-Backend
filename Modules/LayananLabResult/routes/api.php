<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabResult\Http\Controllers\LabResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // Transisi status dipisahkan dari update data agar tidak terjadi tak sengaja.
    Route::post('lab-results/{lab_result}/transition', [LabResultController::class, 'transition']);

    Route::apiResource('lab-results', LabResultController::class)->only(['index', 'show']);

    Route::apiResource('lab-results', LabResultController::class)->only(['store']);
});
