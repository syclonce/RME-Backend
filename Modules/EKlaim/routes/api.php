<?php

use Illuminate\Support\Facades\Route;
use Modules\EKlaim\Http\Controllers\EKlaimController;

Route::middleware(['auth:sanctum'])->prefix('v1/eklaim')->group(function () {
    Route::get('calls', [EKlaimController::class, 'index']);
    Route::get('calls/{eklaimCall}', [EKlaimController::class, 'show']);

    Route::post('calls', [EKlaimController::class, 'store']);

    // Orkestrasi 7 langkah (ala grouper() legacy): satu endpoint menjalankan
    // urutan yang benar; store() generik di atas tetap untuk panggilan satuan.
    Route::post('claims/{claim}/submit', [EKlaimController::class, 'submitClaim']);
});
