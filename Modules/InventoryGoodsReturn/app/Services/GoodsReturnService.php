<?php

namespace Modules\InventoryGoodsReturn\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReturn\Models\GoodsReturn;

/**
 * State machine retur barang (pola sama dengan LabOrderService::TRANSITIONS +
 * lockForUpdate + cek status dua kali).
 */
class GoodsReturnService
{
    private const TRANSITIONS = [
        'pending' => ['approved', 'rejected'],
        'approved' => ['completed'],
        'completed' => [],
        'rejected' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): GoodsReturn
    {
        return DB::transaction(fn () => GoodsReturn::create([
            ...Arr::except($data, 'status'),
            'return_number' => $data['return_number'] ?? GoodsReturn::generateReturnNumber(),
            'returned_at' => $data['returned_at'] ?? now(),
            'returned_by' => $user->id,
            'status' => 'pending',
        ]));
    }

    public function transition(GoodsReturn $return, string $target): GoodsReturn
    {
        $allowed = self::TRANSITIONS[$return->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi retur {$return->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($return, $target) {
            $locked = GoodsReturn::query()->whereKey($return->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status retur sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
