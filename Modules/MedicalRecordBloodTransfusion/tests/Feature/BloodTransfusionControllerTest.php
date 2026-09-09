<?php

namespace Modules\MedicalRecordBloodTransfusion\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\KemkesBloodType\Models\BloodType;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class BloodTransfusionControllerTest extends TestCase
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

    public function test_it_starts_a_transfusion(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $bloodType = BloodType::factory()->create();
        $administeredBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/blood-transfusions', [
            'visit_id' => $visit->id,
            'blood_type_id' => $bloodType->id,
            'administered_by' => $administeredBy->id,
            'volume_ml' => 350,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'in_progress');
        $this->assertDatabaseHas('blood_transfusions', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_transfusions_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        BloodTransfusion::factory()->count(2)->create(['visit_id' => $visit->id]);
        BloodTransfusion::factory()->create();

        $response = $this->getJson("/api/v1/blood-transfusions?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_completes_a_transfusion(): void
    {
        $this->actingUser();
        $transfusion = BloodTransfusion::factory()->create(['status' => 'in_progress']);

        $response = $this->putJson("/api/v1/blood-transfusions/{$transfusion->id}", [
            'status' => 'completed',
            'ended_at' => now()->toIso8601String(),
        ]);

        $response->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_guest_cannot_access_blood_transfusions(): void
    {
        $this->getJson('/api/v1/blood-transfusions')->assertStatus(401);
    }

    /**
     * Bukti perbaikan: sebelumnya transfusi bisa dicatat pada kunjungan yang
     * RME-nya sudah final. MedicalRecordGate::assertWritable() kini menolaknya.
     */
    public function test_it_rejects_create_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $visit->id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);
        $bloodType = BloodType::factory()->create();
        $administeredBy = Employee::factory()->create();

        $this->postJson('/api/v1/blood-transfusions', [
            'visit_id' => $visit->id,
            'blood_type_id' => $bloodType->id,
            'administered_by' => $administeredBy->id,
        ])->assertStatus(422);

        $this->assertDatabaseCount('blood_transfusions', 0);
    }

    public function test_it_rejects_transition_from_terminal_status(): void
    {
        $this->actingUser();
        $transfusion = BloodTransfusion::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/blood-transfusions/{$transfusion->id}", ['status' => 'in_progress'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $transfusion = BloodTransfusion::factory()->create(['status' => 'in_progress']);

        $this->putJson("/api/v1/blood-transfusions/{$transfusion->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    /** Reaksi transfusi adalah transisi sah dari in_progress, bukan hanya completed/cancelled. */
    public function test_it_records_transfusion_reaction(): void
    {
        $this->actingUser();
        $transfusion = BloodTransfusion::factory()->create(['status' => 'in_progress']);

        $this->putJson("/api/v1/blood-transfusions/{$transfusion->id}", [
            'status' => 'stopped_reaction',
            'reaction_notes' => 'Demam dan gatal-gatal, transfusi dihentikan.',
        ])->assertOk()->assertJsonPath('data.status', 'stopped_reaction');
    }

    public function test_it_cannot_create_with_status_injected_from_request(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $bloodType = BloodType::factory()->create();
        $administeredBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/blood-transfusions', [
            'visit_id' => $visit->id,
            'blood_type_id' => $bloodType->id,
            'administered_by' => $administeredBy->id,
            'status' => 'completed',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'in_progress');
    }
}
