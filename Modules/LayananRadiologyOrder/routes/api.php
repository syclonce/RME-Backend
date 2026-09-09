<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananRadiologyOrder\Http\Controllers\RadiologyOrderController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('radiology-orders', RadiologyOrderController::class)->only(['index', 'show'])->parameters(['radiology-orders' => 'rad_order']);

    Route::apiResource('radiology-orders', RadiologyOrderController::class)->only(['store', 'update'])->parameters(['radiology-orders' => 'rad_order']);

    // Jadwal & batal lewat gerbang khusus, bukan edit bebas via update() —
    // diserap dari Modules/LayananImagingOrder/routes/api.php.
    Route::post('radiology-orders/{rad_order}/schedule', [RadiologyOrderController::class, 'schedule']);
    Route::post('radiology-orders/{rad_order}/cancel', [RadiologyOrderController::class, 'cancel']);
});
