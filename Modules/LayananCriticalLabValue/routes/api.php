<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananCriticalLabValue\Http\Controllers\CriticalLabValueController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('critical-lab-values', CriticalLabValueController::class)->only(['index', 'show'])->parameters(['critical-lab-values' => 'critical_value']);

    Route::apiResource('critical-lab-values', CriticalLabValueController::class)->only(['store', 'update'])->parameters(['critical-lab-values' => 'critical_value']);

    // Gerbang eksplisit — bukan edit bebas lewat update() — supaya aturan
    // "tidak bisa acknowledged sebelum notified" dan jejak siapa/kapan
    // tidak bisa dilewati.
    Route::post('critical-lab-values/{critical_value}/notify', [CriticalLabValueController::class, 'notify']);
    Route::post('critical-lab-values/{critical_value}/acknowledge', [CriticalLabValueController::class, 'acknowledge']);
});
