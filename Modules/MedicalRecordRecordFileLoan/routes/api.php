<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordRecordFileLoan\Http\Controllers\RecordFileLoanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('record-file-loans', RecordFileLoanController::class)->only(['index', 'show'])->parameters(['record-file-loans' => 'record']);

    Route::apiResource('record-file-loans', RecordFileLoanController::class)->only(['store', 'update', 'destroy'])->parameters(['record-file-loans' => 'record']);

    Route::patch('record-file-loans/{record}/status', [RecordFileLoanController::class, 'transition'])->name('record-file-loans.transition');
});
