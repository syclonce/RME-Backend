<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\MyAccountController;
use Modules\Auth\Http\Controllers\UserController;

// Gerbang peran role:admin lama sudah digantikan RoutePermissionGate global
// (RBAC dinamis, per-aksi) -- lihat rbac-dynamic-permission-plan.
Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('logout-all', [AuthController::class, 'logoutAll']);
        Route::get('me', [AuthController::class, 'me']);
        Route::put('me', [MyAccountController::class, 'updateProfile']);
        Route::put('me/password', [MyAccountController::class, 'updatePassword']);
        Route::get('me/sessions', [MyAccountController::class, 'sessions']);
        Route::delete('me/sessions', [MyAccountController::class, 'revokeAllSessions']);

        Route::apiResource('users', UserController::class);
    });
});
