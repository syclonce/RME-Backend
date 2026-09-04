<?php

namespace Modules\MedicalRecordEpisode\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class MedicalRecordEpisodeWorkflowTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
        $this->user = User::factory()->create();
        $this->user->assignRole('petugas');
        $this->actingAs($this->user, 'sanctum');
    }

    public function test_finalization_requires_clinical_note_and_primary_diagnosis(): void
    {
        $visit = Visit::factory()->create();

        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/start")->assertCreated();
        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/finalize")
            ->assertStatus(422)
            ->assertJsonPath('message', 'Minimal satu catatan klinis wajib tersedia sebelum finalisasi RME. Diagnosis utama wajib tersedia sebelum finalisasi RME.');
    }

    public function test_final_record_is_immutable_until_amendment_cycle(): void
    {
        $visit = Visit::factory()->create();
        ClinicalNote::factory()->create(['visit_id' => $visit->id]);
        Diagnosis::factory()->primary()->create(['visit_id' => $visit->id]);

        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/start")->assertCreated();
        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/finalize")
            ->assertOk()->assertJsonPath('data.status', MedicalRecordEpisode::STATUS_FINALIZED);

        $employee = Employee::factory()->create();
        $payload = ['visit_id' => $visit->id, 'author_id' => $employee->id, 'assessment' => 'Koreksi'];
        $this->postJson('/api/v1/clinical-notes', $payload)->assertStatus(422);

        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/amend", ['reason' => 'Koreksi diagnosis setelah review DPJP'])
            ->assertOk()
            ->assertJsonPath('data.status', MedicalRecordEpisode::STATUS_AMENDING)
            ->assertJsonPath('data.version', 2);

        $this->postJson('/api/v1/clinical-notes', $payload)->assertCreated();
        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/finalize")
            ->assertOk()->assertJsonPath('data.status', MedicalRecordEpisode::STATUS_FINALIZED);

        $this->assertDatabaseCount('medical_record_episode_transitions', 4);
    }

    public function test_finalization_waits_for_open_orders_and_prescriptions(): void
    {
        $visit = Visit::factory()->create();
        ClinicalNote::factory()->create(['visit_id' => $visit->id]);
        Diagnosis::factory()->primary()->create(['visit_id' => $visit->id]);
        LabOrder::factory()->create(['visit_id' => $visit->id, 'status' => 'pending']);
        Prescription::factory()->create(['visit_id' => $visit->id, 'status' => 'active']);

        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/start")->assertCreated();
        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/finalize")
            ->assertStatus(422)
            ->assertJsonPath('message', 'Masih ada order laboratorium yang belum terminal. Masih ada resep yang belum selesai atau dibatalkan.');
    }

    public function test_user_without_clinical_role_cannot_manage_episode(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $visit = Visit::factory()->create();

        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/start")->assertForbidden();
    }
}
