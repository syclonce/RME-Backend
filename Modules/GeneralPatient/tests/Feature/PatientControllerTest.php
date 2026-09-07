<?php

namespace Modules\GeneralPatient\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Tests\TestCase;

class PatientControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }
    private function actingUser(): User
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_lists_patients(): void
    {
        $this->actingUser();
        Patient::factory()->count(3)->create();

        $this->getJson('/api/v1/patients')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_patient_with_auto_generated_medical_record_number(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/patients', ['name' => 'Budi Santoso']);

        $response->assertCreated();
        $mrn = $response->json('data.medical_record_number');
        $this->assertNotEmpty($mrn);
        $this->assertStringStartsWith('RM-'.now()->format('Y').'-', $mrn);
    }

    public function test_it_creates_patient_with_explicit_medical_record_number(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patients', ['name' => 'Siti', 'medical_record_number' => 'RM-CUSTOM-001'])
            ->assertCreated()
            ->assertJsonPath('data.medical_record_number', 'RM-CUSTOM-001');
    }

    public function test_it_records_who_registered_the_patient(): void
    {
        $user = $this->actingUser();

        $this->postJson('/api/v1/patients', ['name' => 'Budi']);

        $this->assertDatabaseHas('patients', ['name' => 'Budi', 'registered_by' => $user->id]);
    }

    public function test_it_supports_unidentified_patients(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->unidentified()->create();

        $this->assertDatabaseHas('patients', ['id' => $patient->id, 'is_unidentified' => true]);
    }

    public function test_it_updates_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $this->putJson("/api/v1/patients/{$patient->id}", ['name' => 'Nama Baru'])
            ->assertOk()
            ->assertJsonPath('data.name', 'Nama Baru');
    }

    public function test_it_deletes_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $this->deleteJson("/api/v1/patients/{$patient->id}")->assertStatus(204);
    }

    public function test_guest_cannot_access_patients(): void
    {
        $this->getJson('/api/v1/patients')->assertStatus(401);
    }

    public function test_it_rejects_demographic_duplicate(): void
    {
        $this->actingUser();
        Patient::factory()->create([
            'name' => 'Agus Wijaya', 'birth_date' => '1985-03-10',
            'birth_place' => 'Garut', 'gender_id' => null, 'address' => 'Jl. Cihanjuang 5',
        ]);

        $this->postJson('/api/v1/patients', [
            'name' => 'Agus Wijaya', 'birth_date' => '1985-03-10',
            'birth_place' => 'Garut', 'address' => 'Jl. Cihanjuang 5',
        ])->assertUnprocessable()->assertJsonValidationErrors('birth_date');
    }

    public function test_unidentified_patient_needs_no_name_and_skips_dedup(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patients', [
            'is_unidentified' => true, 'birth_date' => '2026-09-06', 'address' => 'Depan IGD',
        ])->assertCreated()->assertJsonPath('data.name', 'Tanpa Identitas');

        // Korban kedua dengan data sama tetap boleh (identitas belum ada).
        $this->postJson('/api/v1/patients', [
            'is_unidentified' => true, 'birth_date' => '2026-09-06', 'address' => 'Depan IGD',
        ])->assertCreated();
    }

    public function test_infant_requires_mother_data(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patients', [
            'name' => 'Bayi Ny. Ani', 'is_infant' => true,
        ])->assertUnprocessable()->assertJsonValidationErrors('mother.name');
    }

    public function test_infant_creates_mother_family_row(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/patients', [
            'name' => 'Bayi Ny. Ani', 'is_infant' => true,
            'mother' => ['name' => 'Ani', 'identity_number' => '3201010101900001'],
        ])->assertCreated();

        $this->assertDatabaseHas('patient_families', [
            'patient_id' => $response->json('data.id'),
            'name' => 'Ani', 'relationship' => 'ibu',
            'identity_number' => '3201010101900001',
        ]);
    }
}
