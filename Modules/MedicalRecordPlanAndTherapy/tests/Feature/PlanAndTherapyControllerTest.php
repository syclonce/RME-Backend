<?php

namespace Modules\MedicalRecordPlanAndTherapy\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\MedicalRecordPlanAndTherapy\Models\PlanAndTherapy;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class PlanAndTherapyControllerTest extends TestCase
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
        $orderedBy = \Modules\GeneralDoctor\Models\Doctor::factory()->create();

        $response = $this->postJson('/api/v1/plan-and-therapies', [
            'visit_id' => $visit->id,
            'ordered_by' => $orderedBy->id,
            'plan_description' => fake()->sentence(10),
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'active');
        $this->assertDatabaseHas('plan_and_therapies', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PlanAndTherapy::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/plan-and-therapies');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/plan-and-therapies')->assertStatus(401);
    }

    public function test_it_completes_an_active_plan(): void
    {
        $this->actingUser();
        $record = PlanAndTherapy::factory()->create(['status' => 'active']);

        $this->putJson("/api/v1/plan-and-therapies/{$record->id}", ['status' => 'completed'])
            ->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_revises_then_completes_a_plan(): void
    {
        $this->actingUser();
        $record = PlanAndTherapy::factory()->create(['status' => 'active']);

        $this->putJson("/api/v1/plan-and-therapies/{$record->id}", ['status' => 'revised'])
            ->assertOk()->assertJsonPath('data.status', 'revised');

        $this->putJson("/api/v1/plan-and-therapies/{$record->id}", ['status' => 'completed'])
            ->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_transition_from_terminal_status(): void
    {
        $this->actingUser();
        $record = PlanAndTherapy::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/plan-and-therapies/{$record->id}", ['status' => 'active'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $record = PlanAndTherapy::factory()->create(['status' => 'active']);

        $this->putJson("/api/v1/plan-and-therapies/{$record->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    public function test_it_cannot_create_with_status_injected_from_request(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $orderedBy = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/plan-and-therapies', [
            'visit_id' => $visit->id,
            'ordered_by' => $orderedBy->id,
            'plan_description' => fake()->sentence(10),
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
        $orderedBy = Doctor::factory()->create();

        $this->postJson('/api/v1/plan-and-therapies', [
            'visit_id' => $visit->id,
            'ordered_by' => $orderedBy->id,
            'plan_description' => fake()->sentence(10),
        ])->assertStatus(422);

        $this->assertDatabaseCount('plan_and_therapies', 0);
    }
}
