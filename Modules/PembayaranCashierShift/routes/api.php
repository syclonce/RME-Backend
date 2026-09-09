<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranCashierShift\Http\Controllers\CashierShiftController;

Route::middleware(['auth:sanctum', 'role:petugas|admin'])->prefix('v1')->group(function () {
    Route::get('cashier-shifts', [CashierShiftController::class, 'index'])->name('cashier-shifts.index');
    Route::post('cashiers/{cashier}/shifts/open', [CashierShiftController::class, 'open'])->name('cashier-shifts.open');
    Route::post('cashier-shifts/{shift}/close', [CashierShiftController::class, 'close'])->name('cashier-shifts.close');
});
