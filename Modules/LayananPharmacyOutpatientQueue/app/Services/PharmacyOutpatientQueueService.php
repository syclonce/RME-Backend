<?php

namespace Modules\LayananPharmacyOutpatientQueue\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\LayananPharmacyOutpatientQueue\Models\PharmacyOutpatientQueue;

/**
 * State machine antrean farmasi rawat jalan: waiting -> called -> done.
 * Sama seperti SelfCheckinService — urutan ketat, done hanya valid setelah
 * called (mencegah waktu tunggu nol yang merusak laporan layanan).
 */
class PharmacyOutpatientQueueService
{
    private const TRANSITIONS = [
        'waiting' => ['called'],
        'called' => ['done'],
        'done' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): PharmacyOutpatientQueue
    {
        return DB::transaction(fn () => PharmacyOutpatientQueue::create([
            ...Arr::except($data, ['status', 'called_at', 'completed_at']),
            'status' => 'waiting',
        ]));
    }

    public function transition(PharmacyOutpatientQueue $queue, string $target): PharmacyOutpatientQueue
    {
        $allowed = self::TRANSITIONS[$queue->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi antrean farmasi {$queue->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($queue, $target) {
            $locked = PharmacyOutpatientQueue::query()->whereKey($queue->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status antrean farmasi sudah berubah.');

            $update = ['status' => $target];
            if ($target === 'called') {
                $update['called_at'] = now();
            } elseif ($target === 'done') {
                $update['completed_at'] = now();
            }

            $locked->update($update);

            return $locked->refresh();
        });
    }
}
