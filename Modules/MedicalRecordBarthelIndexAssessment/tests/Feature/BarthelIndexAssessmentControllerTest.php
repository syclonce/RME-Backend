<?php

namespace Modules\MedicalRecordBarthelIndexAssessment\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBarthelIndexAssessment\Models\BarthelIndexAssessment;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class BarthelIndexAssessmentControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/barthel-index-assessments', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', $visit->id);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        BarthelIndexAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/barthel-index-assessments');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = BarthelIndexAssessment::factory()->create();

        $response = $this->getJson("/api/v1/barthel-index-assessments/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = BarthelIndexAssessment::factory()->create();

        $response = $this->putJson("/api/v1/barthel-index-assessments/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = BarthelIndexAssessment::factory()->create();

        $response = $this->deleteJson("/api/v1/barthel-index-assessments/{$record->id}");

        $response->assertNoContent();
    }

    /**
     * Skor dihitung ulang server: klien mengirim total yang SALAH (0) padahal
     * sub-itemnya berjumlah 100 (mandiri penuh). Yang tersimpan harus 100.
     */
    public function test_total_score_is_recomputed_server_side(): void
    {
        $this->actingUser();

        $visit = Visit::factory()->create();

        $response = $this->postJson('/api/v1/barthel-index-assessments', [
            'visit_id' => $visit->id,
            'feeding' => 10,
            'bathing' => 5,
            'grooming' => 5,
            'dressing' => 10,
            'bowel_control' => 10,
            'bladder_control' => 10,
            'toilet_use' => 10,
            'transfers' => 15,
            'mobility' => 15,
            'stairs' => 10,
            'total_score' => 0, // salah, sengaja
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('barthel_index_assessments', [
            'visit_id' => $visit->id,
            'total_score' => 100,
        ]);
    }

    /**
     * Arah Barthel KEBALIKAN skala risiko: skor tinggi = lebih mandiri.
     * Salah arah akan menandai pasien mandiri sebagai ketergantungan total.
     */
    public function test_interpretation_thresholds(): void
    {
        $this->assertSame('Mandiri', BarthelIndexAssessment::interpretationFor(100));
        $this->assertSame('Ketergantungan ringan', BarthelIndexAssessment::interpretationFor(91));
        $this->assertSame('Ketergantungan sedang', BarthelIndexAssessment::interpretationFor(62));
        $this->assertSame('Ketergantungan berat', BarthelIndexAssessment::interpretationFor(21));
        $this->assertSame('Ketergantungan total', BarthelIndexAssessment::interpretationFor(20));
        $this->assertSame('Ketergantungan total', BarthelIndexAssessment::interpretationFor(0));
    }

    /** Label diturunkan dari skor server, bukan dari ketikan klien. */
    public function test_interpretation_is_derived_not_taken_from_client(): void
    {
        $this->assertLessThanOrEqual(
            30,
            mb_strlen(BarthelIndexAssessment::interpretationFor(0)),
            'Label harus muat di kolom varchar(30).',
        );
    }
}
