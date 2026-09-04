<?php

namespace Modules\MedicalRecordGraceRiskScoreAssessment\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordGraceRiskScoreAssessment\Models\GraceRiskScoreAssessment;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class GraceRiskScoreAssessmentControllerTest extends TestCase
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

        $visit = Visit::factory()->create();

        $payload = [
            'visit_id' => $visit->id,
            'age' => 65,
            'heart_rate' => 88,
            'systolic_bp' => 130,
            'creatinine_mg_dl' => 1.10,
        ];

        $response = $this->postJson('/api/v1/grace-risk-score-assessments', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.age', 65);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        GraceRiskScoreAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/grace-risk-score-assessments');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = GraceRiskScoreAssessment::factory()->create();

        $response = $this->getJson("/api/v1/grace-risk-score-assessments/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = GraceRiskScoreAssessment::factory()->create();

        $response = $this->putJson("/api/v1/grace-risk-score-assessments/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = GraceRiskScoreAssessment::factory()->create();

        $response = $this->deleteJson("/api/v1/grace-risk-score-assessments/{$record->id}");

        $response->assertNoContent();
    }
}
