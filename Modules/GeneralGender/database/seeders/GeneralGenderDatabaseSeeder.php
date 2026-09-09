<?php

namespace Modules\GeneralGender\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralGenderDatabaseSeeder extends Seeder
{
    /**
     * Referensi genders (5 nilai).
     *
     * Sumber: SIMpel legacy — JENIS 2 (jenis kelamin). Kode aslinya dipertahankan di kolom
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
            DB::table('genders')->updateOrInsert(
                ['name' => $row['name']],
                ['code' => $row['code'], 'is_active' => true, 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    /** @return array<int, array{code: string, name: string}> */
    private function rows(): array
    {
        return [
            ['code' => '0', 'name' => 'Tidak diketahui'],
            ['code' => '1', 'name' => 'Laki-Laki'],
            ['code' => '2', 'name' => 'Perempuan'],
            ['code' => '3', 'name' => 'Tidak dapat ditentukan'],
            ['code' => '4', 'name' => 'Tidak mengisi'],
        ];
    }
}
