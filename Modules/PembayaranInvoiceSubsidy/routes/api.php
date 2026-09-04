<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranInvoiceSubsidy\Http\Controllers\InvoiceSubsidyController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('invoice-subsidies', InvoiceSubsidyController::class)->only(['index', 'show'])->parameters(['invoice-subsidies' => 'invoice_subsidy']);

    Route::apiResource('invoice-subsidies', InvoiceSubsidyController::class)->only(['store', 'update', 'destroy'])->parameters(['invoice-subsidies' => 'invoice_subsidy']);

    Route::patch('invoice-subsidies/{invoice_subsidy}/transition', [InvoiceSubsidyController::class, 'transition']);
});
