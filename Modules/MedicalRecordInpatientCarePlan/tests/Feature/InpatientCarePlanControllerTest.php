<?php

namespace Modules\MedicalRecordInpatientCarePlan\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\MedicalRecordInpatientCarePlan\Models\InpatientCarePlan;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class InpatientCarePlanControllerTest extends TestCase
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
        $plannedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/inpatient-care-plans', [
            'visit_id' => $visit->id,
            'planned_by' => $plannedBy->id,
            'care_goals' => fake()->sentence(10),
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'active');
        $this->assertDatabaseHas('inpatient_care_plans', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        InpatientCarePlan::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/inpatient-care-plans');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/inpatient-care-plans')->assertStatus(401);
    }

    public function test_it_completes_an_active_plan(): void
    {
        $this->actingUser();
        $record = InpatientCarePlan::factory()->create(['status' => 'active']);

        $this->putJson("/api/v1/inpatient-care-plans/{$record->id}", ['status' => 'completed'])
            ->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_revises_then_completes_a_plan(): void
    {
        $this->actingUser();
        $record = InpatientCarePlan::factory()->create(['status' => 'active']);

        $this->putJson("/api/v1/inpatient-care-plans/{$record->id}", ['status' => 'revised'])
            ->assertOk()->assertJsonPath('data.status', 'revised');

        $this->putJson("/api/v1/inpatient-care-plans/{$record->id}", ['status' => 'completed'])
            ->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_transition_from_terminal_status(): void
    {
        $this->actingUser();
        $record = InpatientCarePlan::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/inpatient-care-plans/{$record->id}", ['status' => 'active'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $record = InpatientCarePlan::factory()->create(['status' => 'active']);

        $this->putJson("/api/v1/inpatient-care-plans/{$record->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    public function test_it_cannot_create_with_status_injected_from_request(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $plannedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/inpatient-care-plans', [
            'visit_id' => $visit->id,
            'planned_by' => $plannedBy->id,
            'care_goals' => fake()->sentence(10),
            'status' => 'completed',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'active');
    }

    public function test_it_rejects_create_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $visit->id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);
        $plannedBy = Employee::factory()->create();

        $this->postJson('/api/v1/inpatient-care-plans', [
            'visit_id' => $visit->id,
            'planned_by' => $plannedBy->id,
            'care_goals' => fake()->sentence(10),
        ])->assertStatus(422);

        $this->assertDatabaseCount('inpatient_care_plans', 0);
    }
}
