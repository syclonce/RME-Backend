<?php

namespace Modules\GeneralPatientType\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralPatientTypeDatabaseSeeder extends Seeder
{
    /**
     * Kategori pasien (4 nilai).
     *
     * Tidak ada padanan langsung di SIMpel — di sana kategori semacam ini
     * tersebar di beberapa tempat (penjamin, jenis kunjungan). Nilai berikut
     * adalah kategori dasar yang lazim dipakai pendaftaran; tambahkan sesuai
     * kebutuhan faskes lewat menu Master.
     *
     * `code` diberi awalan huruf (bukan angka) untuk menandai bahwa ini
     * kodifikasi internal SIMGOS, bukan warisan kode SIMpel.
     *
     * Idempoten: dicocokkan berdasarkan `name` (kolomnya unik), `code`
     * diperbarui sebagai atribut.
     */
    public function run(): void
    {
        $now = now();

        foreach ($this->rows() as $row) {
            DB::table('patient_types')->updateOrInsert(
                ['name' => $row['name']],
                ['code' => $row['code'], 'is_active' => true, 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    /** @return array<int, array{code: string, name: string}> */
    private function rows(): array
    {
        return [
            ['code' => 'UMUM', 'name' => 'Umum'],
            ['code' => 'BPJS', 'name' => 'BPJS Kesehatan'],
            ['code' => 'ASURANSI', 'name' => 'Asuransi / Perusahaan'],
            ['code' => 'KARYAWAN', 'name' => 'Karyawan / Keluarga Karyawan'],
        ];
    }
}
