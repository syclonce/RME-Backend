<?php

namespace Modules\GeneralReligion\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralReligionDatabaseSeeder extends Seeder
{
    /**
     * Referensi religions (8 nilai).
     *
     * Sumber: SIMpel legacy — JENIS 1 (agama). Kode aslinya dipertahankan di kolom
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
            DB::table('religions')->updateOrInsert(
                ['name' => $row['name']],
                ['code' => $row['code'], 'is_active' => true, 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    /** @return array<int, array{code: string, name: string}> */
    private function rows(): array
    {
        return [
            ['code' => '1', 'name' => 'Islam'],
            ['code' => '2', 'name' => 'Kristen (Protestan)'],
            ['code' => '3', 'name' => 'Katholik'],
            ['code' => '4', 'name' => 'Hindu'],
            ['code' => '5', 'name' => 'Budha'],
            ['code' => '6', 'name' => 'Konghuchu'],
            ['code' => '7', 'name' => 'Kepercayaan Terhadap Tuhan YME / Penghayat'],
            ['code' => '8', 'name' => 'Lain - lain'],
        ];
    }
}
