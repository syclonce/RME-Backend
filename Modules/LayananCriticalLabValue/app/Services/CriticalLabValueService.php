<?php

namespace Modules\LayananCriticalLabValue\Services;

use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananCriticalLabValue\Models\CriticalLabValue;

/**
 * Pencatatan keadaan notifikasi & pengakuan nilai kritis lab.
 *
 * Sengaja HANYA pencatatan state, bukan pengiriman notifikasi (push/email/SMS).
 * EventServiceProvider modul ini kosong ($listen = []) — sebelumnya nilai
 * kritis (mis. kalium 7.0) bisa tercatat di database tapi TIDAK PERNAH ada
 * jejak siapa yang memberitahu dokter atau apakah dokter sudah mengakuinya.
 * Service ini menutup celah itu dengan dua gerbang eksplisit:
 *
 *  - markNotified(): mencatat bahwa nilai kritis sudah disampaikan (lewat
 *    telepon/lisan/dsb — notified_to tetap teks bebas untuk itu) oleh user
 *    yang login.
 *  - acknowledge(): mencatat bahwa dokter/petugas yang berwenang sudah
 *    MENGAKUI menerima nilai tsb. Tidak bisa dilakukan sebelum notified —
 *    pengakuan tanpa pemberitahuan tidak masuk akal dan menyembunyikan
 *    celah komunikasi yang seharusnya terlihat di daftar kerja.
 */
class CriticalLabValueService
{
    /**
     * Tandai nilai kritis sudah diberitahukan. Boleh dipanggil ulang untuk
     * memperbarui tujuan/waktu (mis. dicoba telepon lagi ke dokter lain)
     * selama belum diakui — begitu acknowledged, notifikasi dianggap final.
     */
    public function markNotified(CriticalLabValue $value, string $notifiedTo, User $user): CriticalLabValue
    {
        abort_if(
            $value->acknowledged,
            422,
            "Nilai kritis #{$value->id} sudah diakui; catatan notifikasi tidak dapat diubah lagi.",
        );

        return DB::transaction(function () use ($value, $notifiedTo, $user) {
            $value->update([
                'notified_to' => $notifiedTo,
                'notified_at' => now(),
                'notified_by' => $user->id,
            ]);

            return $value->refresh();
        });
    }

    /**
     * Tandai nilai kritis sudah diakui. Gerbang utama: tidak bisa acknowledged
     * sebelum notified_at terisi — dokter tidak boleh "mengakui" sesuatu yang
     * menurut sistem belum pernah disampaikan kepadanya.
     */
    public function acknowledge(CriticalLabValue $value, User $user): CriticalLabValue
    {
        abort_if(
            $value->notified_at === null,
            422,
            "Nilai kritis #{$value->id} belum ditandai sudah diberitahukan; tidak dapat diakui.",
        );
        abort_if(
            $value->acknowledged,
            422,
            "Nilai kritis #{$value->id} sudah diakui sebelumnya.",
        );

        return DB::transaction(function () use ($value, $user) {
            // Lock + cek ulang: cegah dua request acknowledge konkuren
            // dobel-catat (mis. dua perawat menekan tombol bersamaan).
            $locked = CriticalLabValue::query()->whereKey($value->id)->lockForUpdate()->firstOrFail();
            abort_if($locked->acknowledged, 422, "Nilai kritis #{$value->id} sudah diakui sebelumnya.");

            $locked->update([
                'acknowledged' => true,
                'acknowledged_by' => $user->id,
                'acknowledged_at' => now(),
            ]);

            return $locked->refresh();
        });
    }
}
