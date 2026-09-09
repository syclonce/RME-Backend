<?php

namespace Modules\LayananLeftoverMedicationVoucher\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananLeftoverMedicationVoucher\Models\LeftoverMedicationVoucher;

/**
 * Gerbang forward-only: pending -> redeemed/expired saja. Sekali
 * redeemed/expired, status final (tidak bisa direset ke pending lalu
 * redeem ulang). redeemed_at selalu distempel server saat transisi ke
 * redeemed, tidak pernah dari input klien.
 */
class LeftoverMedicationVoucherService
{
    private const TRANSITIONS = [
        'pending' => ['redeemed', 'expired'],
        'redeemed' => [],
        'expired' => [],
    ];

    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
    ) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): LeftoverMedicationVoucher
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        // Voucher selalu lahir pending; redeemed_at distempel server saat
        // transisi redeem terjadi, bukan dari input klien saat create.
        return DB::transaction(fn () => LeftoverMedicationVoucher::create([
            ...Arr::except($data, ['status', 'redeemed_at']),
            'status' => 'pending',
        ]));
    }

    public function transition(LeftoverMedicationVoucher $voucher, string $target, User $user): LeftoverMedicationVoucher
    {
        $this->medicalRecordGate->assertWritable((int) $voucher->visit_id, $user);

        $allowed = self::TRANSITIONS[$voucher->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi voucher {$voucher->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($voucher, $target) {
            $locked = LeftoverMedicationVoucher::query()->whereKey($voucher->id)->lockForUpdate()->firstOrFail();
            abort_unless(
                in_array($target, self::TRANSITIONS[$locked->status] ?? [], true),
                422,
                "Voucher berstatus '{$locked->status}' tidak dapat diubah statusnya lagi."
            );

            $locked->update([
                'status' => $target,
                'redeemed_at' => $target === 'redeemed' ? now() : $locked->redeemed_at,
            ]);

            return $locked->refresh();
        });
    }
}
