<?php

namespace Modules\InventoryStockRequest\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockRequest\Models\StockRequest;

/**
 * State machine permintaan stok (pola sama dengan LabOrderService::TRANSITIONS +
 * lockForUpdate + cek status dua kali). Memenuhi (fulfill) memotong
 * Item.stock_quantity di transaksi yang sama - dikunci dengan lockForUpdate
 * pada baris item untuk mencegah race saat stok tidak mencukupi.
 */
class StockRequestService
{
    private const TRANSITIONS = [
        'pending' => ['fulfilled', 'rejected'],
        'fulfilled' => [],
        'rejected' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): StockRequest
    {
        return DB::transaction(fn () => StockRequest::create([
            ...Arr::except($data, 'status'),
            'request_number' => $data['request_number'] ?? StockRequest::generateRequestNumber(),
            'requested_at' => $data['requested_at'] ?? now(),
            'requested_by' => $user->id,
            'status' => 'pending',
        ]));
    }

    /**
     * Fulfilling decrements Item.stock_quantity - blocked if stock is
     * insufficient. Rejecting just marks the request, no stock movement.
     */
    public function transition(StockRequest $stockRequest, string $target): StockRequest
    {
        $allowed = self::TRANSITIONS[$stockRequest->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi permintaan stok {$stockRequest->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($stockRequest, $target) {
            $locked = StockRequest::query()->whereKey($stockRequest->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status permintaan stok sudah berubah.');

            if ($target === 'fulfilled') {
                $item = Item::query()->whereKey($locked->item_id)->lockForUpdate()->firstOrFail();

                abort_if($item->stock_quantity < $locked->quantity, 422, 'Stok tidak mencukupi.');

                $item->decrement('stock_quantity', $locked->quantity);
                $locked->update(['status' => 'fulfilled', 'fulfilled_at' => now()]);
            } else {
                $locked->update(['status' => 'rejected']);
            }

            return $locked->refresh();
        });
    }
}
