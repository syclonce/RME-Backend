<?php

namespace Modules\GeneralMaritalStatus\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralMaritalStatusDatabaseSeeder extends Seeder
{
    /**
     * Referensi marital_statuses (4 nilai).
     *
     * Sumber: SIMpel legacy — JENIS 5 (status perkawinan). Kode aslinya dipertahankan di kolom
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
            DB::table('marital_statuses')->updateOrInsert(
                ['name' => $row['name']],
                ['code' => $row['code'], 'is_active' => true, 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    /** @return array<int, array{code: string, name: string}> */
    private function rows(): array
    {
        return [
            ['code' => '1', 'name' => 'Belum Kawin'],
            ['code' => '2', 'name' => 'Kawin'],
            ['code' => '3', 'name' => 'Cerai Hidup'],
            ['code' => '4', 'name' => 'Cerai Mati'],
        ];
    }
}
