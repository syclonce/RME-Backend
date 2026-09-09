<?php

namespace Modules\GeneralRoomClass\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralRoomClassDatabaseSeeder extends Seeder
{
    /**
     * Kelas ruang perawatan (8 nilai).
     *
     * Sumber: SIMpel legacy — `master.kemkes_kelas`, kodifikasi resmi Kemkes
     * yang dipakai pelaporan RL dan klaim. Kode aslinya (0001–0008)
     * dipertahankan di kolom `code`.
     *
     * Idempoten: dicocokkan berdasarkan `name` (kolomnya unik), `code`
     * diperbarui sebagai atribut.
     */
    public function run(): void
    {
        $now = now();

        foreach ($this->rows() as $row) {
            DB::table('room_classes')->updateOrInsert(
                ['name' => $row['name']],
                ['code' => $row['code'], 'is_active' => true, 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    /** @return array<int, array{code: string, name: string}> */
    private function rows(): array
    {
        return [
            ['code' => '0001', 'name' => 'Super VIP'],
            ['code' => '0002', 'name' => 'VIP'],
            ['code' => '0003', 'name' => 'Kelas 1'],
            ['code' => '0004', 'name' => 'Kelas 2'],
            ['code' => '0005', 'name' => 'Kelas 3'],
            ['code' => '0006', 'name' => 'Intermediate'],
            ['code' => '0007', 'name' => 'Isolasi'],
            ['code' => '0008', 'name' => 'Rawat Khusus'],
        ];
    }
}
