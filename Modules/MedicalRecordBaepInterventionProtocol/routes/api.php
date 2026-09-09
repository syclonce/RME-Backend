<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBaepInterventionProtocol\Http\Controllers\BaepInterventionProtocolController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('baep-intervention-protocols', BaepInterventionProtocolController::class)->only(['index', 'show'])->parameters(['baep-intervention-protocols' => 'record']);

    Route::apiResource('baep-intervention-protocols', BaepInterventionProtocolController::class)->only(['store', 'update'])->parameters(['baep-intervention-protocols' => 'record']);
});
