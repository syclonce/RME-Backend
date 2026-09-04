<?php

namespace Modules\PendaftaranReferral\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\PendaftaranReferral\Models\Referral;

/**
 * State machine rujukan: pending -> accepted/cancelled -> completed/cancelled.
 * Sekali completed atau cancelled, rujukan final (tidak ada transisi keluar).
 */
class ReferralService
{
    private const TRANSITIONS = [
        'pending' => ['accepted', 'cancelled'],
        'accepted' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): Referral
    {
        return DB::transaction(fn () => Referral::create([
            ...Arr::except($data, 'status'),
            'referral_number' => $data['referral_number'] ?? Referral::generateReferralNumber(),
            'referred_at' => $data['referred_at'] ?? now(),
            'status' => 'pending',
        ]));
    }

    public function transition(Referral $referral, string $target): Referral
    {
        $allowed = self::TRANSITIONS[$referral->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi rujukan {$referral->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($referral, $target) {
            $locked = Referral::query()->whereKey($referral->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status rujukan sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
