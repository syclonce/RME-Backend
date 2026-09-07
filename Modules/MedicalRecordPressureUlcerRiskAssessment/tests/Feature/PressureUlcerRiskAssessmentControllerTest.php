<?php

namespace Modules\MedicalRecordPressureUlcerRiskAssessment\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Models\PressureUlcerRiskAssessment;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class PressureUlcerRiskAssessmentControllerTest extends TestCase
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
        ];

        $response = $this->postJson('/api/v1/pressure-ulcer-risk-assessments', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', $visit->id);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PressureUlcerRiskAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/pressure-ulcer-risk-assessments');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PressureUlcerRiskAssessment::factory()->create();

        $response = $this->getJson("/api/v1/pressure-ulcer-risk-assessments/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = PressureUlcerRiskAssessment::factory()->create();

        $response = $this->putJson("/api/v1/pressure-ulcer-risk-assessments/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PressureUlcerRiskAssessment::factory()->create();

        $response = $this->deleteJson("/api/v1/pressure-ulcer-risk-assessments/{$record->id}");

        $response->assertNoContent();
    }

    /**
     * Skor dihitung ulang server: klien mengirim total dan risk_level yang
     * SALAH padahal sub-itemnya berjumlah 23 (skor tertinggi -> no_risk).
     * Arah skala Braden terbalik dari Morse/Humpty Dumpty: skor tinggi berarti
     * risiko RENDAH.
     */
    public function test_total_score_is_recomputed_server_side(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();

        $response = $this->postJson('/api/v1/pressure-ulcer-risk-assessments', [
            'visit_id' => $visit->id,
            'sensory_perception' => 4,
            'moisture' => 4,
            'activity' => 4,
            'mobility' => 4,
            'nutrition' => 4,
            'friction_shear' => 3,
            'total_score' => 6,             // salah, sengaja
            'risk_level' => 'high_risk',    // salah, sengaja
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('pressure_ulcer_risk_assessments', [
            'visit_id' => $visit->id,
            'total_score' => 23,
            'risk_level' => 'no_risk',
        ]);
    }

    /** Ambang baku Braden (arah terbalik: skor rendah = risiko tinggi). */
    public function test_risk_level_thresholds(): void
    {
        $this->assertSame('high_risk', PressureUlcerRiskAssessment::riskLevelFor(6));
        $this->assertSame('high_risk', PressureUlcerRiskAssessment::riskLevelFor(12));
        $this->assertSame('moderate_risk', PressureUlcerRiskAssessment::riskLevelFor(13));
        $this->assertSame('moderate_risk', PressureUlcerRiskAssessment::riskLevelFor(14));
        $this->assertSame('mild_risk', PressureUlcerRiskAssessment::riskLevelFor(15));
        $this->assertSame('mild_risk', PressureUlcerRiskAssessment::riskLevelFor(18));
        $this->assertSame('no_risk', PressureUlcerRiskAssessment::riskLevelFor(19));
        $this->assertSame('no_risk', PressureUlcerRiskAssessment::riskLevelFor(23));
    }
}
