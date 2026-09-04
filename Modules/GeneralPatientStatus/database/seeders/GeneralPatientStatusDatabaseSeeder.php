<?php

namespace Modules\GeneralPatientStatus\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralPatientStatusDatabaseSeeder extends Seeder
{
    /**
     * Status vital pasien (2 nilai).
     *
     * Sumber: SIMpel legacy — JENIS 13, dipakai pada `master.pasien.STATUS`.
     * Kode aslinya dipertahankan di kolom `code` supaya pemetaan saat migrasi
     * data tetap bisa dilakukan.
     *
     * Idempoten: dicocokkan berdasarkan `name` (kolomnya unik), `code`
     * diperbarui sebagai atribut.
     */
    public function run(): void
    {
        $now = now();

        foreach ($this->rows() as $row) {
            DB::table('patient_statuses')->updateOrInsert(
                ['name' => $row['name']],
                ['code' => $row['code'], 'is_active' => true, 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    /** @return array<int, array{code: string, name: string}> */
    private function rows(): array
    {
        return [
            ['code' => '1', 'name' => 'Hidup / Aktif'],
            ['code' => '2', 'name' => 'Meninggal'],
        ];
    }
}
