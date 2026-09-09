<?php

namespace Modules\InventoryShipment\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\InventoryShipment\Models\Shipment;

/**
 * State machine pengiriman antar-ward (pola sama dengan
 * LabOrderService::TRANSITIONS + lockForUpdate + cek status dua kali).
 */
class ShipmentService
{
    private const TRANSITIONS = [
        'pending' => ['in_transit', 'cancelled'],
        'in_transit' => ['delivered', 'cancelled'],
        'delivered' => [],
        'cancelled' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): Shipment
    {
        return DB::transaction(fn () => Shipment::create([
            ...Arr::except($data, 'status'),
            'shipped_at' => $data['shipped_at'] ?? now(),
            'status' => 'pending',
        ]));
    }

    public function transition(Shipment $shipment, string $target): Shipment
    {
        $allowed = self::TRANSITIONS[$shipment->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi pengiriman {$shipment->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($shipment, $target) {
            $locked = Shipment::query()->whereKey($shipment->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status pengiriman sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
