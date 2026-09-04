<?php

namespace Modules\PendaftaranWardQueue\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\PendaftaranWardQueue\Models\WardQueue;

/**
 * Penomoran dan pembentukan antrean ruangan.
 *
 * Legacy memakai stored function `generator.generateNoAntrianPoli(RUANGAN, TANGGAL)`
 * yang bersandar pada tabel counter **MyISAM** dengan PK gabungan (TANGGAL, NOMOR) —
 * auto-increment MyISAM me-reset per nilai TANGGAL. Perilaku itu **tidak dapat
 * direplikasi di InnoDB**, jadi penomoran dibangun ulang di sini.
 *
 * Penggantinya: `MAX(queue_number) + 1` per (ruangan, tanggal) di dalam transaksi
 * ber-lock baris, sehingga dua pendaftaran serentak tidak memperoleh nomor kembar.
 */
class WardQueueService
{
    /**
     * Masukkan sebuah pendaftaran ke antrean ruangan.
     *
     * Idempoten: pendaftaran yang sudah mengantre di ruangan dan tanggal yang sama
     * mengembalikan baris yang ada, tidak membuat nomor baru. Ini penting karena
     * pemanggilnya adalah alur pendaftaran yang bisa diulang petugas.
     */
    public function enqueue(int $wardId, int $registrationId, ?Carbon $date = null): WardQueue
    {
        $queueDate = ($date ?? now())->toDateString();

        return DB::transaction(function () use ($wardId, $registrationId, $queueDate) {
            $existing = WardQueue::query()
                ->where('ward_id', $wardId)
                ->where('registration_id', $registrationId)
                ->whereDate('queue_date', $queueDate)
                ->whereIn('status', [WardQueue::STATUS_WAITING, WardQueue::STATUS_CALLED])
                ->first();

            if ($existing !== null) {
                return $existing;
            }

            // lockForUpdate menahan baris antrean ruangan+tanggal ini sampai commit,
            // menggantikan jaminan atomik yang di legacy datang dari AUTO_INCREMENT.
            $lastNumber = WardQueue::query()
                ->where('ward_id', $wardId)
                ->whereDate('queue_date', $queueDate)
                ->lockForUpdate()
                ->max('queue_number');

            return WardQueue::create([
                'ward_id' => $wardId,
                'registration_id' => $registrationId,
                'queue_number' => (int) $lastNumber + 1,
                'queue_date' => $queueDate,
                'status' => WardQueue::STATUS_WAITING,
            ]);
        });
    }

    /**
     * Tandai antrean sebagai terlayani saat pasien diterima di ruangan.
     *
     * `visit_id` diisi di sini supaya antrean tetap dapat ditelusuri ke kunjungan
     * yang dihasilkannya — jejak yang di legacy hilang karena `antrian_ruangan`
     * hanya menyimpan NOPEN.
     */
    public function markServed(int $registrationId, int $wardId, int $visitId): void
    {
        WardQueue::query()
            ->where('registration_id', $registrationId)
            ->where('ward_id', $wardId)
            ->whereIn('status', [WardQueue::STATUS_WAITING, WardQueue::STATUS_CALLED])
            ->update(['status' => WardQueue::STATUS_SERVED, 'visit_id' => $visitId]);
    }
}
