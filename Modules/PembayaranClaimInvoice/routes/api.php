<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranClaimInvoice\Http\Controllers\ClaimInvoiceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('claim-invoices', ClaimInvoiceController::class)->only(['index', 'show'])->parameters(['claim-invoices' => 'claim_invoice']);

    Route::apiResource('claim-invoices', ClaimInvoiceController::class)->only(['store', 'update', 'destroy'])->parameters(['claim-invoices' => 'claim_invoice']);

    Route::patch('claim-invoices/{claim_invoice}/transition', [ClaimInvoiceController::class, 'transition']);
});
