<?php

namespace Modules\GeneralEducation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralEducationDatabaseSeeder extends Seeder
{
    /**
     * Referensi educations (10 nilai).
     *
     * Sumber: SIMpel legacy — JENIS 3 (pendidikan). Kode aslinya dipertahankan di kolom
     * `code` supaya pemetaan saat migrasi data dan bridging (SATUSEHAT/BPJS)
     * tetap bisa dilakukan; `id` sendiri auto-increment milik SIMGOS.
     *
     * Idempoten: dicocokkan berdasarkan `name` (kolomnya unik dan merupakan
     * nilai bisnis yang stabil), sementara `code` diperbarui sebagai atribut.
     * Aman dijalankan berulang, termasuk pada basis data yang sudah berisi
     * baris tanpa `code`.
     */
    public function run(): void
    {
        $now = now();

        foreach ($this->rows() as $row) {
            DB::table('educations')->updateOrInsert(
                ['name' => $row['name']],
                ['code' => $row['code'], 'is_active' => true, 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    /** @return array<int, array{code: string, name: string}> */
    private function rows(): array
    {
        return [
            ['code' => '1', 'name' => 'Tidak/Belum Sekolah'],
            ['code' => '2', 'name' => 'Belum Tamat SD/Sederajat'],
            ['code' => '3', 'name' => 'Tamat SD/Sederajat'],
            ['code' => '4', 'name' => 'SLTP/Sederajat'],
            ['code' => '5', 'name' => 'SLTA/Sederajat'],
            ['code' => '6', 'name' => 'Diploma I/II'],
            ['code' => '7', 'name' => 'Akademi/Diploma III/Sarjana Muda'],
            ['code' => '8', 'name' => 'Diploma IV/Strata I'],
            ['code' => '9', 'name' => 'Strata II'],
            ['code' => '10', 'name' => 'Strata III'],
        ];
    }
}
