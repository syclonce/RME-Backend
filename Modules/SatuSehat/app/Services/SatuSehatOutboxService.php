<?php

namespace Modules\SatuSehat\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;

/**
 * Pengantre kiriman SATUSEHAT.
 *
 * Tabel `satu_sehat_staging_submissions` sudah dirancang benar sejak awal
 * (status pending/sent/failed, `attempts`, `last_error`, sumber polymorphic) —
 * yang belum ada adalah **penulisnya**. Terverifikasi pada audit 2026-09-04:
 * nol kode di alur nyata yang menulis ke tabel ini, sehingga perintah retry yang
 * sudah tersedia tidak pernah punya apa pun untuk dikirim.
 *
 * Perbandingan dengan legacy (peta induk, Temuan 11-12): SIMGOS2 mengirim BPJS
 * secara sinkron di dalam request HTTP dan menyimpan kegagalan sebagai teks di
 * kolom `errMsg*` — tanpa mekanisme membacanya kembali. Antrean SATUSEHAT legacy
 * pun menandai record SELESAI meski pengiriman gagal. Kedua cacat itu justru
 * yang dihindari bentuk tabel ini; tinggal dipakai.
 */
class SatuSehatOutboxService
{
    /**
     * Antrekan satu resource FHIR untuk dikirim worker.
     *
     * Idempoten per (resource_type, source): satu sumber hanya boleh punya satu
     * kiriman yang belum tuntas. Event domain dapat terpicu berkali-kali
     * (mis. `InvoiceLocked` dari lock, markPaid, dan cancel), dan tanpa penjagaan
     * ini antrean akan terisi duplikat yang mengirim data sama berulang kali ke
     * SATUSEHAT.
     *
     * Kiriman yang sudah `sent` sengaja TIDAK menghalangi pembuatan baru: data
     * yang berubah setelah terkirim memang perlu dikirim ulang sebagai pembaruan.
     */
    public function enqueue(string $resourceType, Model $source, array $payload): SatuSehatStagingSubmission
    {
        $existing = SatuSehatStagingSubmission::query()
            ->where('resource_type', $resourceType)
            ->where('source_type', $source::class)
            ->where('source_id', $source->getKey())
            ->whereIn('status', ['pending', 'failed'])
            ->first();

        if ($existing !== null) {
            // Payload diperbarui: yang dikirim nanti harus keadaan TERBARU,
            // bukan potret saat event pertama terpicu.
            $existing->update(['payload' => $payload]);

            return $existing;
        }

        return SatuSehatStagingSubmission::create([
            'resource_type' => $resourceType,
            'source_type' => $source::class,
            'source_id' => $source->getKey(),
            'payload' => $payload,
            'status' => 'pending',
            'attempts' => 0,
        ]);
    }
}
