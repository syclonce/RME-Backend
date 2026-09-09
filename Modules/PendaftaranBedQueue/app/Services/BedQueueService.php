<?php

namespace Modules\PendaftaranBedQueue\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\PendaftaranBedQueue\Models\BedQueue;

/**
 * State machine antrean tempat tidur: waiting -> assigned/cancelled saja.
 * Sama seperti SelfCheckinService — antrean baru selalu 'waiting', dan
 * assigned/cancelled adalah status final (tidak bisa ditransisi lagi).
 */
class BedQueueService
{
    private const TRANSITIONS = [
        'waiting' => ['assigned', 'cancelled'],
        'assigned' => [],
        'cancelled' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): BedQueue
    {
        return DB::transaction(fn () => BedQueue::create([
            ...Arr::except($data, 'status'),
            'status' => 'waiting',
        ]));
    }

    public function transition(BedQueue $queue, string $target): BedQueue
    {
        $allowed = self::TRANSITIONS[$queue->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi antrean tempat tidur {$queue->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($queue, $target) {
            $locked = BedQueue::query()->whereKey($queue->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status antrean tempat tidur sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
