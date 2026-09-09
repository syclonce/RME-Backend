<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranVisit\Http\Controllers\VisitController;

// Gerbang peran role:petugas|admin lama sudah digantikan RoutePermissionGate
// global (RBAC dinamis, per-aksi) -- lihat rbac-dynamic-permission-plan.
// WardScope::canAccessWard() (gerbang objek-level, di dalam controller/
// service) TIDAK terpengaruh sama sekali oleh perubahan ini.
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('visits', VisitController::class);
    Route::post('visits/{visit}/transfer', [VisitController::class, 'transfer']);
    Route::post('visits/{visit}/discharge', [VisitController::class, 'discharge']);
    Route::post('visits/{visit}/finalize-service', [VisitController::class, 'finalizeService']);
});
