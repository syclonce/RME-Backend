<?php

namespace Modules\GeneralOccupation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralOccupationDatabaseSeeder extends Seeder
{
    /**
     * Referensi occupations (92 nilai).
     *
     * Sumber: SIMpel legacy — JENIS 4 (pekerjaan). Kode aslinya dipertahankan di kolom
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
            DB::table('occupations')->updateOrInsert(
                ['name' => $row['name']],
                ['code' => $row['code'], 'is_active' => true, 'updated_at' => $now, 'created_at' => $now],
            );
        }
    }

    /** @return array<int, array{code: string, name: string}> */
    private function rows(): array
    {
        return [
            ['code' => '1', 'name' => 'Belum/Tidak Bekerja'],
            ['code' => '2', 'name' => 'Mengurus Rumah Tangga'],
            ['code' => '3', 'name' => 'Pelajar/Mahasiswa'],
            ['code' => '4', 'name' => 'Pensiunan'],
            ['code' => '5', 'name' => 'Pegawai Negeri Sipil'],
            ['code' => '6', 'name' => 'Tentara Nasional Indonesia'],
            ['code' => '7', 'name' => 'Kepolisian RI'],
            ['code' => '8', 'name' => 'Perdagangan'],
            ['code' => '9', 'name' => 'Petani/Pekebun'],
            ['code' => '10', 'name' => 'Peternak'],
            ['code' => '11', 'name' => 'Nelayan/Perikanan'],
            ['code' => '12', 'name' => 'Industri'],
            ['code' => '13', 'name' => 'Konstruksi'],
            ['code' => '14', 'name' => 'Transportasi'],
            ['code' => '15', 'name' => 'Karyawan Swasta'],
            ['code' => '16', 'name' => 'Karyawan BUMN'],
            ['code' => '17', 'name' => 'Karyawan BUMD'],
            ['code' => '18', 'name' => 'Karyawan Honorer'],
            ['code' => '19', 'name' => 'Buruh Harian Lepas'],
            ['code' => '20', 'name' => 'Buruh Tani/Perkebunan'],
            ['code' => '21', 'name' => 'Buruh Nelayan/Perikanan'],
            ['code' => '22', 'name' => 'Buruh Peternakan'],
            ['code' => '23', 'name' => 'Pembantu Rumah Tangga'],
            ['code' => '24', 'name' => 'Tukang Cukur'],
            ['code' => '25', 'name' => 'Tukang Listrik'],
            ['code' => '26', 'name' => 'Tukang Batu'],
            ['code' => '27', 'name' => 'Tukang Kayu'],
            ['code' => '28', 'name' => 'Tukang Sol Sepatu'],
            ['code' => '29', 'name' => 'Tukang Las/Pandai Besi'],
            ['code' => '30', 'name' => 'Tukang Jahit'],
            ['code' => '31', 'name' => 'Tukang Gigi'],
            ['code' => '32', 'name' => 'Penata Rias'],
            ['code' => '33', 'name' => 'Penata Busana'],
            ['code' => '34', 'name' => 'Penata Rambut'],
            ['code' => '35', 'name' => 'Mekanik'],
            ['code' => '36', 'name' => 'Seniman'],
            ['code' => '37', 'name' => 'Tabib'],
            ['code' => '38', 'name' => 'Paraji'],
            ['code' => '39', 'name' => 'Perancang Busana'],
            ['code' => '40', 'name' => 'Penterjemah'],
            ['code' => '41', 'name' => 'Imam Mesjid'],
            ['code' => '42', 'name' => 'Pendeta'],
            ['code' => '43', 'name' => 'Pastor'],
            ['code' => '44', 'name' => 'Wartawan'],
            ['code' => '45', 'name' => 'Ustadz/Mubaligh'],
            ['code' => '46', 'name' => 'Juru Masak'],
            ['code' => '47', 'name' => 'Promotor Acara'],
            ['code' => '48', 'name' => 'Anggota DPR-RI'],
            ['code' => '49', 'name' => 'Anggota DPD'],
            ['code' => '50', 'name' => 'Anggota BPK'],
            ['code' => '51', 'name' => 'Presiden'],
            ['code' => '52', 'name' => 'Wakil Presiden'],
            ['code' => '53', 'name' => 'Anggota Mahkamah Konstitusi'],
            ['code' => '54', 'name' => 'Anggota Kabinet/Kementerian'],
            ['code' => '55', 'name' => 'Duta Besar'],
            ['code' => '56', 'name' => 'Gubernur'],
            ['code' => '57', 'name' => 'Wakil Gubernur'],
            ['code' => '58', 'name' => 'Bupati'],
            ['code' => '59', 'name' => 'Wakil Bupati'],
            ['code' => '60', 'name' => 'Walikota'],
            ['code' => '61', 'name' => 'Wakil Walikota'],
            ['code' => '62', 'name' => 'Anggota DPRD Provinsi'],
            ['code' => '63', 'name' => 'Anggota DPRD Kabupaten/Kota'],
            ['code' => '64', 'name' => 'Dosen'],
            ['code' => '65', 'name' => 'Guru'],
            ['code' => '66', 'name' => 'Pilot'],
            ['code' => '67', 'name' => 'Pengacara'],
            ['code' => '68', 'name' => 'Notaris'],
            ['code' => '69', 'name' => 'Arsitek'],
            ['code' => '70', 'name' => 'Akuntan'],
            ['code' => '71', 'name' => 'Konsultan'],
            ['code' => '72', 'name' => 'Dokter'],
            ['code' => '73', 'name' => 'Bidan'],
            ['code' => '74', 'name' => 'Perawat'],
            ['code' => '75', 'name' => 'Apoteker'],
            ['code' => '76', 'name' => 'Psikiater/Psikolog'],
            ['code' => '77', 'name' => 'Penyiar Televisi'],
            ['code' => '78', 'name' => 'Penyiar Radio'],
            ['code' => '79', 'name' => 'Pelaut'],
            ['code' => '80', 'name' => 'Peneliti'],
            ['code' => '81', 'name' => 'Sopir'],
            ['code' => '82', 'name' => 'Pialang'],
            ['code' => '83', 'name' => 'Paranormal'],
            ['code' => '84', 'name' => 'Pedagang'],
            ['code' => '85', 'name' => 'Perangkat Desa'],
            ['code' => '86', 'name' => 'Kepala Desa'],
            ['code' => '87', 'name' => 'Biarawati'],
            ['code' => '88', 'name' => 'Wiraswasta'],
            ['code' => '89', 'name' => 'Lainnya'],
            ['code' => '90', 'name' => 'Anggota DPRD'],
            ['code' => '91', 'name' => 'Mubalig'],
            ['code' => '92', 'name' => 'Pekerja Lepas'],
        ];
    }
}
