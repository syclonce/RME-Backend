<?php

namespace Modules\PembayaranEdc\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\PembayaranEdc\Models\Edc;

/**
 * State machine transaksi EDC (pola sama dengan LabOrderService::TRANSITIONS +
 * lockForUpdate + cek status dua kali).
 */
class EdcService
{
    private const TRANSITIONS = [
        'pending' => ['approved', 'declined'],
        'approved' => [],
        'declined' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): Edc
    {
        return DB::transaction(fn () => Edc::create([
            ...Arr::except($data, 'status'),
            'transaction_at' => $data['transaction_at'] ?? now(),
            'status' => 'pending',
        ]));
    }

    /** @param array<string, mixed> $data */
    public function transition(Edc $edc, string $target, array $data = []): Edc
    {
        $allowed = self::TRANSITIONS[$edc->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi EDC {$edc->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($edc, $target, $data) {
            $locked = Edc::query()->whereKey($edc->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status transaksi EDC sudah berubah.');
            $locked->update([...Arr::except($data, 'status'), 'status' => $target]);

            return $locked->refresh();
        });
    }
}
