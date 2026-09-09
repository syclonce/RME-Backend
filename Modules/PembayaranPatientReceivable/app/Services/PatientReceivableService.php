<?php

namespace Modules\PembayaranPatientReceivable\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;

/**
 * Pola mengikuti Modules\LayananLabOrder\Services\LabOrderService: TRANSITIONS
 * map + lockForUpdate + cek status ganda di dalam transaksi.
 *
 * Nilai status dari PatientReceivable::STATUSES (migrasi
 * 2026_08_13_000091): outstanding, settled, written_off.
 *
 * Aturan legacy "pelunasan piutang harus berurutan - pelunasan sebelumnya
 * wajib final sebelum yang baru dibuat" (peta induk Temuan 9,
 * PelunasanPiutangPasienResource.php:26) diterapkan di sini pada level
 * piutang per invoice: satu invoice cuma boleh punya SATU piutang pasien
 * yang masih outstanding pada satu waktu. Piutang baru untuk invoice yang
 * sama hanya bisa dibuat setelah yang sebelumnya final (settled/written_off).
 */
class PatientReceivableService
{
    private const TRANSITIONS = [
        'outstanding' => ['settled', 'written_off'],
        'settled' => [],
        'written_off' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): PatientReceivable
    {
        // Piutang pasien adalah jangkar batas settlement kumulatif, jadi
        // jumlahnya dibatasi bagian tagihan yang memang ditanggung pasien
        // (total - coverage penjamin). Tanpa ini petugas bisa mencetak
        // piutang oversized lalu melunasinya penuh lewat endpoint settlement
        // (lihat PatientReceivableAnchorIntegrityPocTest).
        $invoice = Invoice::findOrFail($data['invoice_id']);
        abort_if(
            (float) $data['amount'] > (float) $invoice->patient_share,
            422,
            'Jumlah piutang melebihi bagian tagihan yang ditanggung pasien.'
        );

        return DB::transaction(function () use ($data) {
            $hasOutstanding = PatientReceivable::query()
                ->where('invoice_id', $data['invoice_id'])
                ->where('status', 'outstanding')
                ->lockForUpdate()
                ->exists();

            abort_if($hasOutstanding, 422, 'Invoice ini masih punya piutang pasien outstanding yang belum final.');

            return PatientReceivable::create([
                ...Arr::except($data, 'status'),
                'status' => 'outstanding',
            ]);
        });
    }

    public function transition(PatientReceivable $receivable, string $target): PatientReceivable
    {
        $allowed = self::TRANSITIONS[$receivable->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi piutang pasien {$receivable->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($receivable, $target) {
            $locked = PatientReceivable::query()->whereKey($receivable->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status piutang pasien sudah berubah.');

            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
