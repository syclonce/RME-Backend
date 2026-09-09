<?php

namespace Modules\PendaftaranReservation\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\PendaftaranReservation\Models\Reservation;

/**
 * State machine reservasi tempat tidur/poli: pending -> confirmed/cancelled,
 * confirmed -> completed/cancelled. Selesai/batal adalah status final.
 */
class ReservationService
{
    private const TRANSITIONS = [
        'pending' => ['confirmed', 'cancelled'],
        'confirmed' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): Reservation
    {
        return DB::transaction(fn () => Reservation::create([
            ...Arr::except($data, 'status'),
            'status' => 'pending',
        ]));
    }

    public function transition(Reservation $reservation, string $target): Reservation
    {
        $allowed = self::TRANSITIONS[$reservation->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi reservasi {$reservation->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($reservation, $target) {
            $locked = Reservation::query()->whereKey($reservation->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status reservasi sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
