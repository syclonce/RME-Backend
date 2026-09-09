<?php

namespace Modules\GeneralWardVisitType\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralWardVisitTypeDatabaseSeeder extends Seeder
{
    /**
     * 3 baris pertama (code 1,2,3) adalah rekonstruksi lama dari kode ExtJS
     * legacy (lihat histori git untuk detail) dan SUDAH DIPAKAI data — id/code
     * TIDAK DIUBAH di sini.
     *
     * 12 baris sisanya (code 0, 4-14) diverifikasi ulang 2026-09-03 langsung
     * dari dump data legacy SIMGOS2 (bukan rekonstruksi dari kode), sumber:
     * db/new/master/data/referensi.sql baris 186-199 dan 1679, kelompok
     * JENIS=15 ("Jenis Kunjungan Ruangan"):
     *   (15, 0, 'Bukan Ruangan Kunjungan / Pelayanan')
     *   (15, 4..13, 'Laboratorium' .. 'Patologi Anatomi')
     *   (15, 14, 'Radioterapi')  -- baris terpisah, muncul lagi di baris 1679
     *
     * `triggers_emergency_flag` hanya true untuk code '2' (Gawat Darurat),
     * konsisten dengan flag igdirna pada kode ExtJS legacy yang jadi dasar
     * 3 baris pertama.
     */
    public function run(): void
    {
        $now = now();

        $rows = [
            [
                'name' => 'Rawat Jalan',
                'code' => '1',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Gawat Darurat',
                'code' => '2',
                'is_active' => true,
                'triggers_emergency_flag' => true,
            ],
            [
                'name' => 'Rawat Inap',
                'code' => '3',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Bukan Ruangan Kunjungan / Pelayanan',
                'code' => '0',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Laboratorium',
                'code' => '4',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Radiologi',
                'code' => '5',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Kamar Operasi',
                'code' => '6',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Hemodialisa',
                'code' => '7',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Endoscopy',
                'code' => '8',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Litotripsi',
                'code' => '9',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Hiperbarik',
                'code' => '10',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Farmasi',
                'code' => '11',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Kamar Bersalin',
                'code' => '12',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Patologi Anatomi',
                'code' => '13',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
            [
                'name' => 'Radioterapi',
                'code' => '14',
                'is_active' => true,
                'triggers_emergency_flag' => false,
            ],
        ];

        // updateOrInsert berdasarkan `code` (kolom UNIQUE) supaya seeder aman
        // dijalankan berulang tanpa duplikasi atau error constraint.
        foreach ($rows as $row) {
            DB::table('ward_visit_types')->updateOrInsert(
                ['code' => $row['code']],
                $row + ['updated_at' => $now, 'created_at' => $now]
            );
        }
    }
}
