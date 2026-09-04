<?php

namespace Modules\PembayaranCorporateReceivable\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\PembayaranCorporateReceivable\Models\CorporateReceivable;

/**
 * Pola mengikuti Modules\LayananLabOrder\Services\LabOrderService: TRANSITIONS
 * map + lockForUpdate + cek status ganda di dalam transaksi.
 *
 * Nilai status dari CorporateReceivable::STATUSES (migrasi
 * 2026_08_13_000092): outstanding, settled, written_off.
 *
 * Aturan legacy "pelunasan piutang harus berurutan - pelunasan sebelumnya
 * wajib final sebelum yang baru dibuat" (peta induk Temuan 9,
 * PelunasanPiutangPerusahaanResource.php:26) diterapkan di sini pada level
 * piutang per invoice: satu invoice cuma boleh punya SATU piutang korporat
 * yang masih outstanding pada satu waktu. Piutang baru untuk invoice yang
 * sama hanya bisa dibuat setelah yang sebelumnya final (settled/written_off).
 */
class CorporateReceivableService
{
    private const TRANSITIONS = [
        'outstanding' => ['settled', 'written_off'],
        'settled' => [],
        'written_off' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): CorporateReceivable
    {
        return DB::transaction(function () use ($data) {
            $hasOutstanding = CorporateReceivable::query()
                ->where('invoice_id', $data['invoice_id'])
                ->where('status', 'outstanding')
                ->lockForUpdate()
                ->exists();

            abort_if($hasOutstanding, 422, 'Invoice ini masih punya piutang korporat outstanding yang belum final.');

            return CorporateReceivable::create([
                ...Arr::except($data, 'status'),
                'status' => 'outstanding',
            ]);
        });
    }

    public function transition(CorporateReceivable $receivable, string $target): CorporateReceivable
    {
        $allowed = self::TRANSITIONS[$receivable->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi piutang korporat {$receivable->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($receivable, $target) {
            $locked = CorporateReceivable::query()->whereKey($receivable->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status piutang korporat sudah berubah.');

            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
