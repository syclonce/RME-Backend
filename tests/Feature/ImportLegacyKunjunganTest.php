<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class ImportLegacyKunjunganTest extends TestCase
{
    use RefreshDatabase;

    private function writeRows(array $rows): string
    {
        $path = sys_get_temp_dir().'/legacy-kunjungan-'.uniqid().'.json';
        file_put_contents($path, json_encode($rows));

        return $path;
    }

    public function test_impor_menautkan_registrasi_dan_menutup_tujuan(): void
    {
        $registration = Registration::factory()->create(['registration_number' => '2609060001']);
        $ward = Ward::factory()->create();
        \Modules\PendaftaranVisitDestination\Models\VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
            'status' => 'pending',
        ]);
        $path = $this->writeRows([[
            'NOMOR' => 'RJ2609060001', 'NOPEN' => '2609060001',
            'RUANGAN' => $ward->id, 'MASUK' => '2026-09-06 08:15:00', 'STATUS' => 1,
        ]]);

        $this->artisan('legacy:import-kunjungan', ['file' => $path])->assertSuccessful();

        $visit = Visit::firstWhere('visit_number', 'RJ2609060001');
        $this->assertNotNull($visit);
        $this->assertSame('active', $visit->status);
        $this->assertSame(
            'accepted',
            \Modules\PendaftaranVisitDestination\Models\VisitDestination::firstWhere('registration_id', $registration->id)->status
        );
    }

    public function test_status_selesai_dan_batal_terpetakan(): void
    {
        $registration = Registration::factory()->create(['registration_number' => '2609060002']);
        $path = $this->writeRows([
            ['NOMOR' => 'K1', 'NOPEN' => '2609060002', 'MASUK' => '2026-09-01 08:00:00',
             'KELUAR' => '2026-09-03 10:00:00', 'STATUS' => 2],
            ['NOMOR' => 'K2', 'NOPEN' => '2609060002', 'MASUK' => '2026-09-04 08:00:00', 'STATUS' => 0],
        ]);

        $this->artisan('legacy:import-kunjungan', ['file' => $path])->assertSuccessful();

        $this->assertSame('discharged', Visit::firstWhere('visit_number', 'K1')->status);
        $this->assertNotNull(Visit::firstWhere('visit_number', 'K1')->discharged_at);
        $this->assertSame('cancelled', Visit::firstWhere('visit_number', 'K2')->status);
    }

    public function test_nopen_belum_migrasi_masuk_karantina(): void
    {
        $path = $this->writeRows([['NOMOR' => 'K9', 'NOPEN' => 'TAK-ADA']]);

        $this->artisan('legacy:import-kunjungan', ['file' => $path])->assertSuccessful();

        $this->assertDatabaseCount('visits', 0);
        $this->assertFileExists(preg_replace('/\.json$/', '', $path).'.quarantine.json');
    }
}
