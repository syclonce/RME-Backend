<?php

namespace Modules\MedicalRecordSurgery\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\MedicalRecordSurgery\Models\Surgery;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class SurgeryControllerTest extends TestCase
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

    public function test_it_schedules_a_surgery(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $surgeon = Employee::factory()->create();

        $response = $this->postJson('/api/v1/surgeries', [
            'visit_id' => $visit->id,
            'surgeon_id' => $surgeon->id,
            'procedure_name' => 'Appendectomy',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'scheduled');
        $this->assertDatabaseHas('surgeries', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_surgeries_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        Surgery::factory()->count(2)->create(['visit_id' => $visit->id]);
        Surgery::factory()->create();

        $response = $this->getJson("/api/v1/surgeries?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_completes_a_surgery(): void
    {
        $this->actingUser();
        $surgery = Surgery::factory()->create(['status' => 'in_progress']);

        $response = $this->putJson("/api/v1/surgeries/{$surgery->id}", [
            'status' => 'completed',
            'ended_at' => now()->toIso8601String(),
        ]);

        $response->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_guest_cannot_access_surgeries(): void
    {
        $this->getJson('/api/v1/surgeries')->assertStatus(401);
    }

    /**
     * Bukti perbaikan: sebelumnya operasi bisa dicatat pada kunjungan yang
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
        $surgeon = Employee::factory()->create();

        $this->postJson('/api/v1/surgeries', [
            'visit_id' => $visit->id,
            'surgeon_id' => $surgeon->id,
            'procedure_name' => 'Appendectomy',
        ])->assertStatus(422);

        $this->assertDatabaseCount('surgeries', 0);
    }

    public function test_it_rejects_skipping_surgery_workflow_state(): void
    {
        $this->actingUser();
        $surgery = Surgery::factory()->create(['status' => 'scheduled']);

        $this->putJson("/api/v1/surgeries/{$surgery->id}", ['status' => 'completed'])
            ->assertStatus(422);
    }

    public function test_it_rejects_transition_from_terminal_status(): void
    {
        $this->actingUser();
        $surgery = Surgery::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/surgeries/{$surgery->id}", ['status' => 'in_progress'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $surgery = Surgery::factory()->create(['status' => 'scheduled']);

        $this->putJson("/api/v1/surgeries/{$surgery->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    public function test_it_cannot_create_with_status_injected_from_request(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $surgeon = Employee::factory()->create();

        $response = $this->postJson('/api/v1/surgeries', [
            'visit_id' => $visit->id,
            'surgeon_id' => $surgeon->id,
            'procedure_name' => 'Appendectomy',
            'status' => 'completed',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'scheduled');
    }

    public function test_it_can_cancel_a_scheduled_surgery(): void
    {
        $this->actingUser();
        $surgery = Surgery::factory()->create(['status' => 'scheduled']);

        $this->putJson("/api/v1/surgeries/{$surgery->id}", ['status' => 'cancelled'])
            ->assertOk()->assertJsonPath('data.status', 'cancelled');
    }
}
