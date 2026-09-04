<?php

namespace Modules\PembayaranClaimInvoice\Providers;

use App\Events\InvoiceLocked;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\PembayaranClaimInvoice\Listeners\CreateClaimInvoiceOnLock;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        InvoiceLocked::class => [CreateClaimInvoiceOnLock::class],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * Off by default - no module uses event auto-discovery, and leaving it on
     * makes every module scan/reflect a Listeners directory on every boot
     * (real cost at 50+ modules). Flip to true only if a module actually adds
     * listeners.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = false;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void {}
}
