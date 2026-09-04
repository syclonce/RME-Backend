<?php

namespace Modules\PembayaranClaimInvoice\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;

/**
 * Pola mengikuti Modules\LayananLabOrder\Services\LabOrderService: TRANSITIONS
 * map + lockForUpdate + cek status ganda di dalam transaksi.
 *
 * PENTING - konsistensi dengan alur klaim yang sudah ada, JANGAN diganggu:
 * - Modules\PembayaranClaimInvoice\Listeners\CreateClaimInvoiceOnLock membuat
 *   ClaimInvoice berstatus 'draft' saat invoice dikunci (lewat ClaimInvoice::create(),
 *   bukan lewat service ini) - service ini tidak menyentuh listener itu.
 * - Modules\EKlaim\Services\ClaimSubmissionOrchestrator::submit() mengubah
 *   'draft' -> 'submitted' langsung lewat $claim->update() setelah rangkaian
 *   7-langkah E-Klaim sukses - TRANSITIONS di sini mengizinkan transisi yang
 *   sama (draft -> submitted) supaya endpoint transisi manual tidak
 *   berkontradiksi dengan orkestrator, tapi service ini TIDAK dipanggil oleh
 *   orkestrator (orkestrator tetap menulis langsung, sudah diaudit terpisah).
 *
 * Nilai status dari ClaimInvoice::STATUSES (migrasi 2026_08_13_128000):
 * draft, submitted, verified, paid, rejected.
 */
class ClaimInvoiceService
{
    private const TRANSITIONS = [
        'draft' => ['submitted'],
        'submitted' => ['verified', 'rejected'],
        'verified' => ['paid', 'rejected'],
        'paid' => [],
        'rejected' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): ClaimInvoice
    {
        return DB::transaction(fn () => ClaimInvoice::create([
            ...Arr::except($data, 'status'),
            'claim_number' => $data['claim_number'] ?? ClaimInvoice::generateClaimNumber(),
            'status' => 'draft',
        ]));
    }

    public function transition(ClaimInvoice $claim, string $target, ?array $extra = null): ClaimInvoice
    {
        $allowed = self::TRANSITIONS[$claim->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi klaim {$claim->status} → {$target} tidak diizinkan.");

        if ($target === 'rejected') {
            abort_if(empty($extra['rejection_reason'] ?? null), 422, 'Alasan penolakan wajib diisi.');
        }

        return DB::transaction(function () use ($claim, $target, $extra) {
            $locked = ClaimInvoice::query()->whereKey($claim->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status klaim sudah berubah.');

            $attrs = ['status' => $target];

            if ($target === 'submitted') {
                $attrs['submitted_at'] = $locked->submitted_at ?? now();
            }

            if ($target === 'verified') {
                $attrs['verified_amount'] = $extra['verified_amount'] ?? $locked->claim_amount;
            }

            if ($target === 'rejected') {
                $attrs['rejection_reason'] = $extra['rejection_reason'];
            }

            $locked->update($attrs);

            return $locked->refresh();
        });
    }
}
