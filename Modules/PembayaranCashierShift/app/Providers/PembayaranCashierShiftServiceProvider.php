<?php

namespace Modules\PembayaranCashierShift\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class PembayaranCashierShiftServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'PembayaranCashierShift';
    protected string $nameLower = 'pembayarancashiershift';
    protected array $providers = [EventServiceProvider::class, RouteServiceProvider::class];
}
