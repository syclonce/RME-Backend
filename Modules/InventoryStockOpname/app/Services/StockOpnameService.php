<?php

namespace Modules\InventoryStockOpname\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\InventoryStockOpname\Models\StockOpname;

/**
 * State machine stok opname (pola sama dengan LabOrderService::TRANSITIONS +
 * lockForUpdate + cek status dua kali).
 */
class StockOpnameService
{
    private const TRANSITIONS = [
        'in_progress' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): StockOpname
    {
        return DB::transaction(fn () => StockOpname::create([
            ...Arr::except($data, 'status'),
            'status' => 'in_progress',
        ]));
    }

    public function transition(StockOpname $opname, string $target): StockOpname
    {
        $allowed = self::TRANSITIONS[$opname->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi stok opname {$opname->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($opname, $target) {
            $locked = StockOpname::query()->whereKey($opname->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status stok opname sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
