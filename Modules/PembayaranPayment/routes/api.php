<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranPayment\Http\Controllers\PaymentController;

// Gerbang peran role:petugas|admin lama sudah digantikan RoutePermissionGate
// global (RBAC dinamis, per-aksi) -- lihat rbac-dynamic-permission-plan.
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('payments', PaymentController::class)->only(['index', 'show', 'store']);
    Route::post('payments/{payment}/reverse', [PaymentController::class, 'reverse']);
});
