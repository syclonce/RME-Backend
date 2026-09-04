<?php

namespace Modules\MedicalRecordMorseFallScaleAssessment\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordMorseFallScaleAssessment\Models\MorseFallScaleAssessment;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class MorseFallScaleAssessmentControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/morse-fall-scale-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'history_of_falling' => fake()->randomElement([0,25]),
            'secondary_diagnosis' => fake()->randomElement([0,15]),
            'ambulatory_aid' => fake()->randomElement([0,15,30]),
            'iv_therapy' => fake()->randomElement([0,20]),
            'gait' => fake()->randomElement([0,10,20]),
            'mental_status' => fake()->randomElement([0,15]),
            'total_score' => fake()->numberBetween(0,125),
            'risk_level' => fake()->randomElement(['LOW','MODERATE','HIGH']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('morse_fall_scale_assessments', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        MorseFallScaleAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/morse-fall-scale-assessments');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/morse-fall-scale-assessments')->assertStatus(401);
    }

    /**
     * Skor dihitung ulang server: klien mengirim total yang SALAH (25) padahal
     * sub-itemnya berjumlah 105. Yang tersimpan harus 105 / risiko tinggi.
     */
    public function test_total_score_is_recomputed_server_side(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $employee = Employee::factory()->create();

        $this->postJson('/api/v1/morse-fall-scale-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $employee->id,
            'history_of_falling' => 25,
            'secondary_diagnosis' => 15,
            'ambulatory_aid' => 30,
            'iv_therapy' => 20,
            'gait' => 0,
            'mental_status' => 15,
            'total_score' => 25,        // salah, sengaja
            'risk_level' => 'LOW',      // salah, sengaja
        ])->assertCreated();

        $this->assertDatabaseHas('morse_fall_scale_assessments', [
            'visit_id' => $visit->id,
            'total_score' => 105,
            'risk_level' => 'HIGH',
        ]);
    }

    /** Ambang baku Morse: <25 rendah, 25-44 sedang, >=45 tinggi. */
    public function test_risk_level_thresholds(): void
    {
        $this->assertSame('LOW', MorseFallScaleAssessment::riskLevelFor(24));
        $this->assertSame('MODERATE', MorseFallScaleAssessment::riskLevelFor(25));
        $this->assertSame('MODERATE', MorseFallScaleAssessment::riskLevelFor(44));
        $this->assertSame('HIGH', MorseFallScaleAssessment::riskLevelFor(45));
    }
}
