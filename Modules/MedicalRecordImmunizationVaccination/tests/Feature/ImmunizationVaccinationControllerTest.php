<?php

namespace Modules\MedicalRecordImmunizationVaccination\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordImmunizationVaccination\Models\ImmunizationVaccination;
use Tests\TestCase;

class ImmunizationVaccinationControllerTest extends TestCase
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

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();
        $patientId = Patient::factory()->create();
        $administeredBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/immunization-vaccinations', [
            'patient_id' => $patientId->id,
            'vaccine_name' => 'Test value',
            'administered_at' => now()->toDateTimeString(),
            'administered_by' => $administeredBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('immunization_vaccinations', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ImmunizationVaccination::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/immunization-vaccinations');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ImmunizationVaccination::factory()->create();

        $this->getJson("/api/v1/immunization-vaccinations/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ImmunizationVaccination::factory()->create();

        $this->deleteJson("/api/v1/immunization-vaccinations/{$record->id}")->assertStatus(204);
    }

    /**
     * Bukti perbaikan: sebelumnya catatan imunisasi bisa ditulis ke kunjungan
     * yang RME-nya sudah final. MedicalRecordGate::assertWritable() kini
     * menolaknya.
     */
    public function test_it_rejects_create_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $visit->id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);
        $patient = Patient::factory()->create();
        $administeredBy = Employee::factory()->create();

        $this->postJson('/api/v1/immunization-vaccinations', [
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'vaccine_name' => 'BCG',
            'administered_at' => now()->toDateTimeString(),
            'administered_by' => $administeredBy->id,
        ])->assertStatus(422);

        $this->assertDatabaseCount('immunization_vaccinations', 0);
    }

    /** Imunisasi tanpa visit_id (mis. posyandu) tidak digerbang - tidak ada episode RME untuk digerbang. */
    public function test_it_creates_record_without_visit_context(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $administeredBy = Employee::factory()->create();

        $this->postJson('/api/v1/immunization-vaccinations', [
            'patient_id' => $patient->id,
            'vaccine_name' => 'BCG',
            'administered_at' => now()->toDateTimeString(),
            'administered_by' => $administeredBy->id,
        ])->assertCreated()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_cannot_inject_status_from_request(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $administeredBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/immunization-vaccinations', [
            'patient_id' => $patient->id,
            'vaccine_name' => 'BCG',
            'administered_at' => now()->toDateTimeString(),
            'administered_by' => $administeredBy->id,
            'status' => 'cancelled',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_update_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $record = ImmunizationVaccination::factory()->create(['visit_id' => $visit->id]);
        MedicalRecordEpisode::create([
            'visit_id' => $visit->id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);

        $this->putJson("/api/v1/immunization-vaccinations/{$record->id}", [
            'adverse_reaction' => 'Muncul ruam merah.',
        ])->assertStatus(422);
    }

    public function test_it_rejects_delete_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $record = ImmunizationVaccination::factory()->create(['visit_id' => $visit->id]);
        MedicalRecordEpisode::create([
            'visit_id' => $visit->id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);

        $this->deleteJson("/api/v1/immunization-vaccinations/{$record->id}")->assertStatus(422);
        $this->assertDatabaseHas('immunization_vaccinations', ['id' => $record->id]);
    }
}
