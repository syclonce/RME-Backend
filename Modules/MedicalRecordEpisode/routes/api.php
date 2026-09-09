<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordEpisode\Http\Controllers\MedicalRecordEpisodeController;

Route::middleware(['auth:sanctum', 'role:petugas|admin'])->prefix('v1')->group(function () {
    Route::get('visits/{visit}/medical-record', [MedicalRecordEpisodeController::class, 'show'])->name('medical-record.show');
    Route::post('visits/{visit}/medical-record/start', [MedicalRecordEpisodeController::class, 'start'])->name('medical-record.start');
    Route::post('visits/{visit}/medical-record/finalize', [MedicalRecordEpisodeController::class, 'finalize'])->name('medical-record.finalize');
    Route::post('visits/{visit}/medical-record/amend', [MedicalRecordEpisodeController::class, 'amend'])->name('medical-record.amend');
});
