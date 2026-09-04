<?php

namespace Modules\PembayaranTransfer\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\PembayaranTransfer\Models\Transfer;

/**
 * State machine transfer bank (pola sama dengan LabOrderService::TRANSITIONS +
 * lockForUpdate + cek status dua kali).
 */
class TransferService
{
    private const TRANSITIONS = [
        'pending' => ['verified', 'rejected'],
        'verified' => [],
        'rejected' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): Transfer
    {
        return DB::transaction(fn () => Transfer::create([
            ...Arr::except($data, 'status'),
            'transferred_at' => $data['transferred_at'] ?? now(),
            'status' => 'pending',
        ]));
    }

    /** @param array<string, mixed> $data */
    public function transition(Transfer $transfer, string $target, array $data = []): Transfer
    {
        $allowed = self::TRANSITIONS[$transfer->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi transfer {$transfer->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($transfer, $target, $data) {
            $locked = Transfer::query()->whereKey($transfer->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status transfer sudah berubah.');
            $locked->update([...Arr::except($data, 'status'), 'status' => $target]);

            return $locked->refresh();
        });
    }
}
