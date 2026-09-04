<?php

namespace Modules\KemkesBloodType\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KemkesBloodTypeDatabaseSeeder extends Seeder
{
    /**
     * Referensi blood_types (13 nilai).
     *
     * Sumber: SIMpel legacy — JENIS 6 (golongan darah). Kode aslinya dipertahankan di kolom
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
            DB::table('blood_types')->updateOrInsert(
                ['name' => $row['name']],
                ['code' => $row['code'], 'is_active' => true, 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    /** @return array<int, array{code: string, name: string}> */
    private function rows(): array
    {
        return [
            ['code' => '1', 'name' => 'A'],
            ['code' => '2', 'name' => 'B'],
            ['code' => '3', 'name' => 'AB'],
            ['code' => '4', 'name' => 'O'],
            ['code' => '5', 'name' => 'A+'],
            ['code' => '6', 'name' => 'A-'],
            ['code' => '7', 'name' => 'B+'],
            ['code' => '8', 'name' => 'B-'],
            ['code' => '9', 'name' => 'AB+'],
            ['code' => '10', 'name' => 'AB-'],
            ['code' => '11', 'name' => 'O-'],
            ['code' => '12', 'name' => 'O+'],
            ['code' => '13', 'name' => 'Tidak Tahu'],
        ];
    }
}
