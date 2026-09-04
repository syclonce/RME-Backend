<?php

namespace Modules\PembayaranInvoiceSubsidy\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoiceSubsidy\Models\InvoiceSubsidy;

/**
 * Pola mengikuti Modules\LayananLabOrder\Services\LabOrderService: TRANSITIONS
 * map + lockForUpdate + cek status ganda di dalam transaksi.
 *
 * Nilai status dari InvoiceSubsidy::STATUSES (migrasi 2026_08_13_127500):
 * pending, approved, rejected.
 */
class InvoiceSubsidyService
{
    private const TRANSITIONS = [
        'pending' => ['approved', 'rejected'],
        'approved' => [],
        'rejected' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): InvoiceSubsidy
    {
        return DB::transaction(fn () => InvoiceSubsidy::create([
            ...Arr::except($data, 'status'),
            'status' => 'pending',
        ]));
    }

    public function transition(InvoiceSubsidy $subsidy, string $target, User $approver): InvoiceSubsidy
    {
        $allowed = self::TRANSITIONS[$subsidy->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi subsidi {$subsidy->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($subsidy, $target, $approver) {
            $locked = InvoiceSubsidy::query()->whereKey($subsidy->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status subsidi sudah berubah.');

            $attrs = ['status' => $target];

            if ($target === 'approved') {
                $attrs['approved_by'] = $approver->id;
                $attrs['approved_at'] = now();
            }

            $locked->update($attrs);

            return $locked->refresh();
        });
    }
}
