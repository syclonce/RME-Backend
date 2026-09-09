<?php

namespace Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Models\HumptyDumptyFallScaleAssessment;
use Tests\TestCase;

class HumptyDumptyFallScaleAssessmentControllerTest extends TestCase
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
        $assessedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/humpty-dumpty-fall-scale-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'age_score' => fake()->numberBetween(1,4),
            'gender_score' => fake()->numberBetween(1,3),
            'diagnosis_score' => fake()->numberBetween(1,4),
            'cognitive_impairment_score' => fake()->numberBetween(1,3),
            'environmental_score' => fake()->numberBetween(1,4),
            'surgery_sedation_score' => fake()->numberBetween(1,3),
            'medication_score' => fake()->numberBetween(1,3),
            'total_score' => fake()->numberBetween(7,23),
            'risk_level' => fake()->randomElement(['LOW','HIGH']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('humpty_dumpty_fall_scale_assessments', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        HumptyDumptyFallScaleAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/humpty-dumpty-fall-scale-assessments');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/humpty-dumpty-fall-scale-assessments')->assertStatus(401);
    }

    /**
     * Skor dihitung ulang server: klien mengirim total yang SALAH (7) padahal
     * sub-itemnya berjumlah 20 (>=12 -> risiko tinggi). Yang tersimpan harus
     * 20 / HIGH, bukan 7 / LOW.
     */
    public function test_total_score_is_recomputed_server_side(): void
    {
        $this->actingUser();
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create();
        $employee = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $this->postJson('/api/v1/humpty-dumpty-fall-scale-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $employee->id,
            'age_score' => 4,
            'gender_score' => 3,
            'diagnosis_score' => 4,
            'cognitive_impairment_score' => 3,
            'environmental_score' => 4,
            'surgery_sedation_score' => 1,
            'medication_score' => 1,
            'total_score' => 7,        // salah, sengaja
            'risk_level' => 'LOW',     // salah, sengaja
        ])->assertCreated();

        $this->assertDatabaseHas('humpty_dumpty_fall_scale_assessments', [
            'visit_id' => $visit->id,
            'total_score' => 20,
            'risk_level' => 'HIGH',
        ]);
    }

    /** Ambang baku Humpty Dumpty: <12 rendah, >=12 tinggi. */
    public function test_risk_level_thresholds(): void
    {
        $this->assertSame('LOW', HumptyDumptyFallScaleAssessment::riskLevelFor(11));
        $this->assertSame('HIGH', HumptyDumptyFallScaleAssessment::riskLevelFor(12));
    }
}
