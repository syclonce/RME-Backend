<?php

namespace Modules\GeneralWardType\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralWardTypeDatabaseSeeder extends Seeder
{
    /**
     * `ward_types` adalah padanan tabel legacy `master.jenis_ruangan` —
     * BUKAN jenis kunjungan (itu `ward_visit_types`), tapi jenjang hierarki
     * organisasi ruangan (dipakai `wards.type_id`). Sumber: dump data legacy
     * db/new/master/data/jenis_ruangan.sql baris 17-21 (5 baris, verified
     * 2026-09-03, diambil apa adanya).
     */
    public function run(): void
    {
        $now = now();

        $rows = [
            [
                'name' => 'Direktur Utama',
                'code' => '1',
                'is_active' => true,
            ],
            [
                'name' => 'Direksi',
                'code' => '2',
                'is_active' => true,
            ],
            [
                'name' => 'Bagian / Bidang / Instalasi',
                'code' => '3',
                'is_active' => true,
            ],
            [
                'name' => 'Sub. Bagian / Seksi / Unit',
                'code' => '4',
                'is_active' => true,
            ],
            [
                'name' => 'Sub. Unit',
                'code' => '5',
                'is_active' => true,
            ],
        ];

        // updateOrInsert berdasarkan `code` (kolom UNIQUE) supaya seeder aman
        // dijalankan berulang tanpa duplikasi atau error constraint.
        foreach ($rows as $row) {
            DB::table('ward_types')->updateOrInsert(
                ['code' => $row['code']],
                $row + ['updated_at' => $now, 'created_at' => $now]
            );
        }
    }
}
