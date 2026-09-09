<?php

namespace Modules\GeneralWard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\GeneralWardVisitType\Models\WardVisitType;

class GeneralWardDatabaseSeeder extends Seeder
{
    /**
     * Ruangan DEMO/CONTOH secukupnya supaya field ward_id di wizard
     * Pendaftaran Kunjungan punya isi untuk diuji — BUKAN replikasi daftar
     * ruangan rumah sakit sungguhan. Data ruangan riil beda-beda per
     * instalasi (SIMGOS single-faskes per ADR 0005) dan wajib diisi admin
     * faskes sendiri lewat modul GeneralWard (CRUD yang sudah ada), bukan
     * lewat seeder aplikasi ini.
     */
    public function run(): void
    {
        $now = now();

        $visitTypeIdByCode = WardVisitType::query()->pluck('id', 'code');

        $rawatJalanId = $visitTypeIdByCode->get('1');
        $gawatDaruratId = $visitTypeIdByCode->get('2');
        $rawatInapId = $visitTypeIdByCode->get('3');

        $rows = [
            [
                'name' => 'Poli Umum',
                'type_id' => null,
                'visit_type_id' => $rawatJalanId,
                'allows_request' => true,
                'is_active' => true,
            ],
            [
                'name' => 'IGD',
                'type_id' => null,
                'visit_type_id' => $gawatDaruratId,
                'allows_request' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Ruang Rawat Inap Melati',
                'type_id' => null,
                'visit_type_id' => $rawatInapId,
                'allows_request' => true,
                'is_active' => true,
            ],
        ];

        foreach (array_chunk($rows, 500) as $chunk) {
            DB::table('wards')->insert(array_map(static fn ($row) => $row + [
                'created_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ], $chunk));
        }
    }
}
