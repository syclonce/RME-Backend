<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranConsultation\Http\Controllers\ConsultationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('consultations', ConsultationController::class)->only(['index', 'show']);

    Route::apiResource('consultations', ConsultationController::class)->only(['store']);

    // Feedback konsul dipisahkan dari pengiriman, mengikuti legacy yang memakai
    // menu + privilege berbeda untuk mengirim (110301) dan menjawab (110401).
    Route::post('consultations/{consultation}/answer', [ConsultationController::class, 'answer']);
    Route::post('consultations/{consultation}/cancel', [ConsultationController::class, 'cancel']);
});
