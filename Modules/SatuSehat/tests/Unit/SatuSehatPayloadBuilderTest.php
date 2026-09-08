<?php

namespace Modules\SatuSehat\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Modules\GeneralPatient\Models\Patient;
use Modules\SatuSehat\Services\SatuSehatPatientBuilder;
use Modules\SatuSehatRawatJalan\Services\RawatJalanEncounterBuilder;
use Tests\TestCase;

/**
 * Payload dibangun dari nomor rule validator sandbox (lihat log pengiriman),
 * bukan tebakan: tiap assert di bawah memetakan ke rule yang pernah menolak.
 */
class SatuSehatPayloadBuilderTest extends TestCase
{
    use RefreshDatabase;

    private function seedWilayah(): int
    {
        DB::table('indonesia_provinces')->insert(['code' => '32', 'name' => 'Jawa Barat']);
        DB::table('indonesia_cities')->insert(['code' => '3273', 'province_code' => '32', 'name' => 'Kota Bandung']);
        DB::table('indonesia_districts')->insert(['code' => '3273020', 'city_code' => '3273', 'name' => 'Coblong']);
        // Kode desa 10-digit (format laravolt); hierarki cocok city 3273.
        return (int) DB::table('indonesia_villages')->insertGetId([
            'code' => '3273021004', 'district_code' => '3273020', 'name' => 'Dago',
        ]);
    }

    public function test_patient_memuat_semua_elemen_wajib_validator(): void
    {
        $villageId = $this->seedWilayah();
        $genderId = \Modules\GeneralGender\Models\Gender::query()->create(['code' => '2', 'name' => 'Perempuan'])->id;
        $patient = Patient::factory()->create([
            'nik' => '3201010101900001',
            'gender_id' => $genderId,
            'birth_date' => '1990-01-01',
            'address' => 'Jl. Dago 1',
            'postal_code' => '40135',
            'village_id' => $villageId,
        ]);
        config(['satusehat.organization_id' => 'org-1']);

        $payload = app(SatuSehatPatientBuilder::class)->build($patient);

        $this->assertSame('female', $payload['gender']);
        $this->assertFalse($payload['multipleBirthBoolean']); // rule 10167/10813
        $ext = $payload['address'][0]['extension'][0]['extension'];
        $byUrl = collect($ext)->keyBy('url');
        $this->assertSame('32', $byUrl['province']['valueCode']); // rule 10621/10622
        $this->assertSame('3273', $byUrl['city']['valueCode']);
        $this->assertSame('3273020', $byUrl['district']['valueCode']);
        $this->assertSame('3273021004', $byUrl['village']['valueCode']);
        $this->assertSame('Organization/org-1', $payload['managingOrganization']['reference']);
    }

    public function test_administrative_codes_diselesaikan_dari_db(): void
    {
        $villageId = $this->seedWilayah();

        $codes = app(SatuSehatPatientBuilder::class)->administrativeCodes($villageId);

        $this->assertSame([
            'village' => '3273021004', 'district' => '3273020',
            'city' => '3273', 'province' => '32',
        ], $codes);
    }

    public function test_encounter_diagnosis_hanya_bila_condition_ada(): void
    {
        $builder = app(RawatJalanEncounterBuilder::class);
        $base = [
            'registration_id' => 'REG-1', 'service_type_code' => 'DBG01',
            'service_type_display' => 'Poli Umum', 'patient_id' => 'P1',
            'patient_name' => 'Tes', 'practitioner_id' => 'D1',
            'practitioner_name' => 'dr. Tes', 'location_id' => 'L1',
            'location_name' => 'Poli Umum', 'period_start' => '2026-09-07T08:00:00+07:00',
        ];

        // Rule 10457: tanpa diagnosis key tidak ada (encounter arrived).
        $this->assertArrayNotHasKey('diagnosis', $builder->build($base));

        $with = $builder->build($base + ['diagnosis_condition_id' => 'C1']);
        $this->assertSame('Condition/C1', $with['diagnosis'][0]['condition']['reference']);
        $this->assertSame(1, $with['diagnosis'][0]['rank']);
    }

    public function test_ketiga_builder_memakai_trait_diagnosis_yang_sama(): void
    {
        foreach ([
            \Modules\SatuSehatRawatInap\Services\RawatInapEncounterBuilder::class,
            \Modules\SatuSehatIgd\Services\IgdEncounterBuilder::class,
        ] as $class) {
            $this->assertContains(
                \Modules\SatuSehat\Support\BuildsEncounterDiagnosis::class,
                class_uses_recursive($class)
            );
        }
    }
}
