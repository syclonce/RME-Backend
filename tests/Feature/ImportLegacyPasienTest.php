<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Modules\GeneralPatient\Models\Patient;
use Tests\TestCase;

class ImportLegacyPasienTest extends TestCase
{
    use RefreshDatabase;

    private function writeRows(array $rows): string
    {
        $path = sys_get_temp_dir().'/legacy-pasien-'.uniqid().'.json';
        file_put_contents($path, json_encode($rows));

        return $path;
    }

    public function test_impor_barisan_valid_dan_konversi_latin1(): void
    {
        $latinName = mb_convert_encoding('Siti Rahayu', 'ISO-8859-1', 'UTF-8');
        $path = $this->writeRows([[
            'NORM' => '12345', 'NAMA' => $latinName, 'TANGGAL_LAHIR' => '1990-05-01',
            'TEMPAT_LAHIR' => 'Bandung', 'ALAMAT' => 'Jl. Merdeka 1',
        ]]);

        $this->artisan('legacy:import-pasien', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseHas('patients', [
            'medical_record_number' => '12345',
            'name' => 'Siti Rahayu',
            'birth_date' => '1990-05-01 00:00:00',
        ]);
        $this->assertSame('Siti Rahayu', Patient::firstWhere('medical_record_number', '12345')->name);
    }

    public function test_norm_ganda_dilewati_tidak_ditimpa(): void
    {
        Patient::factory()->create(['medical_record_number' => '777']);
        $path = $this->writeRows([['NORM' => '777', 'NAMA' => 'Orang Lain']]);

        $this->artisan('legacy:import-pasien', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseCount('patients', 1);
    }

    public function test_nik_ganda_dan_duplikat_demografis_dilewati(): void
    {
        Patient::factory()->create([
            'nik' => '3201010101900001', 'name' => 'Budi', 'birth_date' => '1990-01-01',
            'birth_place' => 'Cimahi', 'address' => 'Jl. A',
        ]);
        $path = $this->writeRows([
            ['NORM' => '1', 'NAMA' => 'X', 'NIK' => '3201010101900001'],
            ['NORM' => '2', 'NAMA' => 'Budi', 'TANGGAL_LAHIR' => '1990-01-01',
             'TEMPAT_LAHIR' => 'Cimahi', 'ALAMAT' => 'Jl. A'],
        ]);

        $this->artisan('legacy:import-pasien', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseCount('patients', 1);
    }

    public function test_baris_rusak_masuk_karantina(): void
    {
        $path = $this->writeRows([
            ['NORM' => '9', 'NAMA' => 'Tanggal Rusak', 'TANGGAL_LAHIR' => 'bukan-tanggal'],
        ]);

        $this->artisan('legacy:import-pasien', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseCount('patients', 0);
        $quarantine = preg_replace('/\.json$/', '', $path).'.quarantine.json';
        $this->assertFileExists($quarantine);
        $this->assertStringContainsString('Tanggal Rusak', (string) file_get_contents($quarantine));
    }

    public function test_dry_run_tidak_menulis(): void
    {
        $path = $this->writeRows([['NORM' => '5', 'NAMA' => 'Coba']]);

        $this->artisan('legacy:import-pasien', ['file' => $path, '--dry-run' => true])->assertSuccessful();

        $this->assertDatabaseCount('patients', 0);
    }

    public function test_kode_master_dipetakan_ke_id_simgos(): void
    {
        $genderId = \Modules\GeneralGender\Models\Gender::query()->create(['code' => '2', 'name' => 'Perempuan'])->id;
        $religionId = \Modules\GeneralReligion\Models\Religion::query()->create(['code' => '1', 'name' => 'Islam'])->id;

        $path = $this->writeRows([[
            'NORM' => '88', 'NAMA' => 'Dewi', 'JENIS_KELAMIN' => '2', 'AGAMA' => '1',
        ]]);

        $this->artisan('legacy:import-pasien', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseHas('patients', [
            'medical_record_number' => '88', 'gender_id' => $genderId, 'religion_id' => $religionId,
        ]);
    }
}
