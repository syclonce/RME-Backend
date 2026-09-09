<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\MedicalRecordPatientNutritionProblem\Models\PatientNutritionProblem;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class PatientNutritionProblemControllerTest extends TestCase
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
        $identifiedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/patient-nutrition-problems', [
            'visit_id' => $visit->id,
            'identified_by' => $identifiedBy->id,
            'problem_category' => fake()->randomElement(['underweight','overweight','malnutrition_risk','swallowing_difficulty','poor_intake']),
            'problem_description' => fake()->sentence(8),
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'open');
        $this->assertDatabaseHas('patient_nutrition_problems', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PatientNutritionProblem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/patient-nutrition-problems');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/patient-nutrition-problems')->assertStatus(401);
    }

    public function test_it_progresses_then_resolves_a_problem(): void
    {
        $this->actingUser();
        $record = PatientNutritionProblem::factory()->create(['status' => 'open']);

        $this->putJson("/api/v1/patient-nutrition-problems/{$record->id}", ['status' => 'in_progress'])
            ->assertOk()->assertJsonPath('data.status', 'in_progress');

        $this->putJson("/api/v1/patient-nutrition-problems/{$record->id}", ['status' => 'resolved'])
            ->assertOk()->assertJsonPath('data.status', 'resolved');
    }

    public function test_it_resolves_directly_from_open(): void
    {
        $this->actingUser();
        $record = PatientNutritionProblem::factory()->create(['status' => 'open']);

        $this->putJson("/api/v1/patient-nutrition-problems/{$record->id}", ['status' => 'resolved'])
            ->assertOk()->assertJsonPath('data.status', 'resolved');
    }

    public function test_it_rejects_transition_from_terminal_status(): void
    {
        $this->actingUser();
        $record = PatientNutritionProblem::factory()->create(['status' => 'resolved']);

        $this->putJson("/api/v1/patient-nutrition-problems/{$record->id}", ['status' => 'open'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $record = PatientNutritionProblem::factory()->create(['status' => 'open']);

        $this->putJson("/api/v1/patient-nutrition-problems/{$record->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    public function test_it_cannot_create_with_status_injected_from_request(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $identifiedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/patient-nutrition-problems', [
            'visit_id' => $visit->id,
            'identified_by' => $identifiedBy->id,
            'problem_category' => 'malnutrition_risk',
            'problem_description' => fake()->sentence(8),
            'status' => 'resolved',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'open');
    }

    public function test_it_rejects_create_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $visit->id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);
        $identifiedBy = Employee::factory()->create();

        $this->postJson('/api/v1/patient-nutrition-problems', [
            'visit_id' => $visit->id,
            'identified_by' => $identifiedBy->id,
            'problem_category' => 'malnutrition_risk',
            'problem_description' => fake()->sentence(8),
        ])->assertStatus(422);

        $this->assertDatabaseCount('patient_nutrition_problems', 0);
    }
}
