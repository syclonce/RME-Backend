<?php

namespace Modules\MedicalRecordModifiedBarthelIndexAssessment\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Models\ModifiedBarthelIndexAssessment;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class ModifiedBarthelIndexAssessmentControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/modified-barthel-index-assessments', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', $visit->id);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ModifiedBarthelIndexAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/modified-barthel-index-assessments');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ModifiedBarthelIndexAssessment::factory()->create();

        $response = $this->getJson("/api/v1/modified-barthel-index-assessments/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = ModifiedBarthelIndexAssessment::factory()->create();

        $response = $this->putJson("/api/v1/modified-barthel-index-assessments/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ModifiedBarthelIndexAssessment::factory()->create();

        $response = $this->deleteJson("/api/v1/modified-barthel-index-assessments/{$record->id}");

        $response->assertNoContent();
    }

    /**
     * Skor dihitung ulang server: klien mengirim total yang SALAH (0) padahal
     * sub-itemnya berjumlah 100 (mandiri penuh). Yang tersimpan harus 100.
     */
    public function test_total_score_is_recomputed_server_side(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/modified-barthel-index-assessments', [
            'visit_id' => 1,
            'feeding' => 10,
            'bathing' => 5,
            'personal_hygiene' => 5,
            'dressing' => 10,
            'bowel_control' => 10,
            'bladder_control' => 10,
            'toilet_use' => 10,
            'chair_bed_transfer' => 15,
            'ambulation' => 15,
            'stairs' => 10,
            'total_score' => 0, // salah, sengaja
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('modified_barthel_index_assessments', [
            'visit_id' => 1,
            'total_score' => 100,
        ]);
    }
}
