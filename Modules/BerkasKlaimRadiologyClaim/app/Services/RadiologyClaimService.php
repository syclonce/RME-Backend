<?php

namespace Modules\BerkasKlaimRadiologyClaim\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\BerkasKlaimRadiologyClaim\Models\RadiologyClaim;

/**
 * Pola mengikuti Modules\LayananLabOrder\Services\LabOrderService: TRANSITIONS
 * map + lockForUpdate + cek status ganda di dalam transaksi.
 *
 * Nilai status diambil dari UpdateRadiologyClaimRequest (satu-satunya
 * tempat status ganda didefinisikan sebelum service ini ada) dan migrasi
 * (default 'draft'): draft, submitted, approved, rejected.
 */
class RadiologyClaimService
{
    private const TRANSITIONS = [
        'draft' => ['submitted'],
        'submitted' => ['approved', 'rejected'],
        'approved' => [],
        'rejected' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): RadiologyClaim
    {
        return DB::transaction(fn () => RadiologyClaim::create([
            ...Arr::except($data, 'status'),
            'status' => 'draft',
        ]));
    }

    public function transition(RadiologyClaim $claim, string $target): RadiologyClaim
    {
        $allowed = self::TRANSITIONS[$claim->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi klaim radiologi {$claim->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($claim, $target) {
            $locked = RadiologyClaim::query()->whereKey($claim->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status klaim radiologi sudah berubah.');

            $attrs = ['status' => $target];
            if ($target === 'submitted') {
                $attrs['submitted_at'] = $locked->submitted_at ?? now();
            }

            $locked->update($attrs);

            return $locked->refresh();
        });
    }
}
