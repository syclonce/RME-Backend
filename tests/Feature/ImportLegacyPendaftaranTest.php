<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranRegistration\Models\Registration;
use Tests\TestCase;

class ImportLegacyPendaftaranTest extends TestCase
{
    use RefreshDatabase;

    private function writeRows(array $rows): string
    {
        $path = sys_get_temp_dir().'/legacy-pendaftaran-'.uniqid().'.json';
        file_put_contents($path, json_encode($rows));

        return $path;
    }

    public function test_impor_membentuk_rantai_registrasi_tujuan_antrean(): void
    {
        $patient = Patient::factory()->create(['medical_record_number' => '100']);
        $ward = Ward::factory()->create();
        $path = $this->writeRows([[
            'NOPEN' => '2609060001', 'NORM' => '100',
            'TANGGAL' => '2026-09-06 08:00:00', 'RUANGAN' => $ward->id,
        ]]);

        $this->artisan('legacy:import-pendaftaran', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseHas('registrations', [
            'registration_number' => '2609060001', 'patient_id' => $patient->id,
        ]);
        $registration = Registration::firstWhere('registration_number', '2609060001');
        $this->assertDatabaseHas('visit_destinations', [
            'registration_id' => $registration->id, 'ward_id' => $ward->id, 'status' => 'pending',
        ]);
        $this->assertDatabaseHas('ward_queues', [
            'registration_id' => $registration->id, 'ward_id' => $ward->id,
        ]);
    }

    public function test_norm_belum_migrasi_masuk_karantina(): void
    {
        $path = $this->writeRows([['NOPEN' => '2609060002', 'NORM' => '999']]);

        $this->artisan('legacy:import-pendaftaran', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseCount('registrations', 0);
        $this->assertFileExists(preg_replace('/\.json$/', '', $path).'.quarantine.json');
    }

    public function test_ruangan_yatim_tetap_impor_tanpa_tujuan(): void
    {
        Patient::factory()->create(['medical_record_number' => '101']);
        $path = $this->writeRows([[
            'NOPEN' => '2609060003', 'NORM' => '101',
            'TANGGAL' => '2026-09-06 09:00:00', 'RUANGAN' => 999999,
        ]]);

        $this->artisan('legacy:import-pendaftaran', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseCount('registrations', 1);
        $this->assertDatabaseCount('visit_destinations', 0);
    }

    public function test_duplikat_harian_dilewati(): void
    {
        $patient = Patient::factory()->create(['medical_record_number' => '102']);
        Registration::factory()->create(['patient_id' => $patient->id]);
        $path = $this->writeRows([[
            'NOPEN' => '2609060004', 'NORM' => '102', 'TANGGAL' => now()->toDateTimeString(),
        ]]);

        $this->artisan('legacy:import-pendaftaran', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseCount('registrations', 1);
    }
}
