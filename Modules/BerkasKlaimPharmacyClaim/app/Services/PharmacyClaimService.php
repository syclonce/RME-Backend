<?php

namespace Modules\BerkasKlaimPharmacyClaim\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\BerkasKlaimPharmacyClaim\Models\PharmacyClaim;

/**
 * Pola mengikuti Modules\LayananLabOrder\Services\LabOrderService: TRANSITIONS
 * map + lockForUpdate + cek status ganda di dalam transaksi.
 *
 * Nilai status diambil dari UpdatePharmacyClaimRequest (satu-satunya
 * tempat status ganda didefinisikan sebelum service ini ada) dan migrasi
 * (default 'draft'): draft, submitted, approved, rejected.
 */
class PharmacyClaimService
{
    private const TRANSITIONS = [
        'draft' => ['submitted'],
        'submitted' => ['approved', 'rejected'],
        'approved' => [],
        'rejected' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): PharmacyClaim
    {
        return DB::transaction(fn () => PharmacyClaim::create([
            ...Arr::except($data, 'status'),
            'status' => 'draft',
        ]));
    }

    public function transition(PharmacyClaim $claim, string $target): PharmacyClaim
    {
        $allowed = self::TRANSITIONS[$claim->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi klaim farmasi {$claim->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($claim, $target) {
            $locked = PharmacyClaim::query()->whereKey($claim->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status klaim farmasi sudah berubah.');

            $attrs = ['status' => $target];
            if ($target === 'submitted') {
                $attrs['submitted_at'] = $locked->submitted_at ?? now();
            }

            $locked->update($attrs);

            return $locked->refresh();
        });
    }
}
