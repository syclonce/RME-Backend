<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

/**
 * Port mekanisme skema `generator` simgos2.
 *
 * Legacy mengambil nomor urut lewat INSERT ke tabel penghitung lalu membaca
 * LAST_INSERT_ID() (db/new/generator/routines/generateNoPendaftaran.sql):
 *
 *     INSERT INTO generator.no_pendaftaran(TANGGAL) VALUES(PTANGGAL);
 *     RETURN CONCAT(DATE_FORMAT(PTANGGAL,'%y%m%d'), LPAD(LAST_INSERT_ID(),4,'0'));
 *
 * Yang ditiru di sini adalah sifatnya, bukan bentuknya: nomor ditetapkan oleh
 * database di dalam satu operasi, sehingga dua permintaan bersamaan TIDAK bisa
 * memperoleh nomor yang sama. Pola lama di repo ini -- `count() + 1` -- bisa,
 * dan kolom nomor yang unique akan menolak yang kalah cepat.
 *
 * Nomor juga tidak didaur ulang: menghapus satu tagihan tidak membuat nomornya
 * dipakai ulang oleh tagihan berikutnya, persis seperti AUTO_INCREMENT legacy.
 */
class NumberSequence
{
    /**
     * Ambil nomor urut berikutnya untuk satu deret.
     *
     * @param  string  $name   jenis nomor, mis. 'registration'
     * @param  string  $scope  cakupan deret, mis. '2026' atau '2026-09-04:ward-7'
     */
    public static function next(string $name, string $scope): int
    {
        // Baris penghitung dibuat sekali; sesudahnya jalurnya hanya UPDATE.
        // insertOrIgnore dipakai supaya dua permintaan pertama yang datang
        // bersamaan tidak saling menggagalkan lewat unique constraint.
        DB::table('number_sequences')->insertOrIgnore([
            'name' => $name,
            'scope' => $scope,
            'value' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return DB::transaction(function () use ($name, $scope) {
            // lockForUpdate menahan baris penghitung sampai transaksi selesai --
            // inilah yang membuat pembacaan dan penulisan jadi satu langkah tak
            // terpisah. Tanpa ini, dua proses membaca nilai sama lalu menulis
            // nilai sama.
            $current = (int) DB::table('number_sequences')
                ->where('name', $name)
                ->where('scope', $scope)
                ->lockForUpdate()
                ->value('value');

            $next = $current + 1;

            DB::table('number_sequences')
                ->where('name', $name)
                ->where('scope', $scope)
                ->update(['value' => $next, 'updated_at' => now()]);

            return $next;
        });
    }

    /**
     * Bentuk nomor lengkap: PREFIX-scope-urutan.
     *
     * @param  int  $pad  lebar digit urutan (legacy memakai LPAD 4 atau 6)
     */
    public static function format(string $prefix, string $name, string $scope, int $pad = 6): string
    {
        return sprintf('%s-%s-%0'.$pad.'d', $prefix, $scope, static::next($name, $scope));
    }
}
