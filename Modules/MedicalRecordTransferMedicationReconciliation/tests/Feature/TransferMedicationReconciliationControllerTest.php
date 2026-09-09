<?php

namespace Modules\MedicalRecordTransferMedicationReconciliation\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\MedicalRecordTransferMedicationReconciliation\Models\TransferMedicationReconciliation;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class TransferMedicationReconciliationControllerTest extends TestCase
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
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create();
        $reconciledBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();
        $transferredToWard = \Modules\GeneralWard\Models\Ward::factory()->create();

        $response = $this->postJson('/api/v1/transfer-med-reconciliations', [
            'visit_id' => $visit->id,
            'reconciled_by' => $reconciledBy->id,
            'transferred_to_ward_id' => $transferredToWard->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'draft');
        $this->assertDatabaseHas('transfer_medication_reconciliations', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TransferMedicationReconciliation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/transfer-med-reconciliations');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/transfer-med-reconciliations')->assertStatus(401);
    }

    public function test_it_completes_a_draft_record(): void
    {
        $this->actingUser();
        $record = TransferMedicationReconciliation::factory()->create(['status' => 'draft']);

        $this->putJson("/api/v1/transfer-med-reconciliations/{$record->id}", ['status' => 'completed'])
            ->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_transition_from_terminal_status(): void
    {
        $this->actingUser();
        $record = TransferMedicationReconciliation::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/transfer-med-reconciliations/{$record->id}", ['status' => 'draft'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $record = TransferMedicationReconciliation::factory()->create(['status' => 'draft']);

        $this->putJson("/api/v1/transfer-med-reconciliations/{$record->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    public function test_it_cannot_create_with_status_injected_from_request(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $reconciledBy = Employee::factory()->create();
        $transferredToWard = Ward::factory()->create();

        $response = $this->postJson('/api/v1/transfer-med-reconciliations', [
            'visit_id' => $visit->id,
            'reconciled_by' => $reconciledBy->id,
            'transferred_to_ward_id' => $transferredToWard->id,
            'status' => 'completed',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'draft');
    }

    public function test_it_rejects_create_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $visit->id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);
        $reconciledBy = Employee::factory()->create();
        $transferredToWard = Ward::factory()->create();

        $this->postJson('/api/v1/transfer-med-reconciliations', [
            'visit_id' => $visit->id,
            'reconciled_by' => $reconciledBy->id,
            'transferred_to_ward_id' => $transferredToWard->id,
        ])->assertStatus(422);

        $this->assertDatabaseCount('transfer_medication_reconciliations', 0);
    }
}
