<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\GeneralCountry\Database\Seeders\GeneralCountryDatabaseSeeder;
use Modules\GeneralDiagnosisCode\Database\Seeders\GeneralDiagnosisCodeDatabaseSeeder;
use Modules\GeneralEducation\Database\Seeders\GeneralEducationDatabaseSeeder;
use Modules\GeneralEthnicity\Database\Seeders\GeneralEthnicityDatabaseSeeder;
use Modules\GeneralGender\Database\Seeders\GeneralGenderDatabaseSeeder;
use Modules\GeneralLanguage\Database\Seeders\GeneralLanguageDatabaseSeeder;
use Modules\GeneralMaritalStatus\Database\Seeders\GeneralMaritalStatusDatabaseSeeder;
use Modules\GeneralOccupation\Database\Seeders\GeneralOccupationDatabaseSeeder;
use Modules\GeneralPatientStatus\Database\Seeders\GeneralPatientStatusDatabaseSeeder;
use Modules\GeneralPatientType\Database\Seeders\GeneralPatientTypeDatabaseSeeder;
use Modules\GeneralReligion\Database\Seeders\GeneralReligionDatabaseSeeder;
use Modules\GeneralRoomClass\Database\Seeders\GeneralRoomClassDatabaseSeeder;
use Modules\GeneralWardType\Database\Seeders\GeneralWardTypeDatabaseSeeder;
use Modules\GeneralWardVisitType\Database\Seeders\GeneralWardVisitTypeDatabaseSeeder;
use Modules\KemkesBloodType\Database\Seeders\KemkesBloodTypeDatabaseSeeder;

/**
 * Data referensi yang dipakai form Pasien dan alur Pendaftaran Kunjungan.
 *
 * Tanpa ini, seluruh dropdown pada form Pasien (Jenis Kelamin, Agama,
 * Pendidikan, Pekerjaan, Status Perkawinan, Golongan Darah, Kebangsaan, Suku,
 * Bahasa, Patient Status, Patient Type) tampil kosong dan tidak bisa dipilih —
 * kondisi yang ditemukan pada 2026-09-03 saat menguji alur pendaftaran.
 *
 * Sebagian besar nilainya diambil dari SIMpel legacy agar kodifikasinya sama,
 * sehingga migrasi data dan bridging SATUSEHAT/BPJS tidak perlu memetakan ulang.
 *
 * Seluruh seeder di dalamnya idempoten (updateOrInsert berdasarkan `code`),
 * jadi aman dijalankan berulang di lingkungan yang sudah berisi data.
 */
class ReferenceDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GeneralGenderDatabaseSeeder::class,
            GeneralReligionDatabaseSeeder::class,
            GeneralEducationDatabaseSeeder::class,
            GeneralOccupationDatabaseSeeder::class,
            GeneralMaritalStatusDatabaseSeeder::class,
            KemkesBloodTypeDatabaseSeeder::class,
            GeneralCountryDatabaseSeeder::class,
            GeneralEthnicityDatabaseSeeder::class,
            GeneralLanguageDatabaseSeeder::class,
            GeneralPatientStatusDatabaseSeeder::class,
            GeneralPatientTypeDatabaseSeeder::class,
            // Referensi alur kunjungan
            GeneralRoomClassDatabaseSeeder::class,
            GeneralDiagnosisCodeDatabaseSeeder::class,
            GeneralWardTypeDatabaseSeeder::class,
            GeneralWardVisitTypeDatabaseSeeder::class,
        ]);
    }
}
