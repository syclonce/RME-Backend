<?php

namespace Modules\MedicalRecordAnamnesis\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordAnamnesis\Models\Anamnesis;
use Tests\TestCase;

class AnamnesisControllerTest extends TestCase
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
        $visitId = Visit::factory()->create();
        $recordedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/anamneses', [
            'visit_id' => $visitId->id,
            'recorded_by' => $recordedBy->id,
            'recorded_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('anamneses', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        Anamnesis::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/anamneses');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = Anamnesis::factory()->create();

        $this->getJson("/api/v1/anamneses/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = Anamnesis::factory()->create();

        $this->deleteJson("/api/v1/anamneses/{$record->id}")->assertStatus(204);
    }

    public function test_it_rejects_store_without_required_fields(): void
    {
        $this->actingUser();
        Visit::factory()->create();
        Employee::factory()->create();

        $this->postJson('/api/v1/anamneses', [])->assertStatus(422);
    }

    public function test_it_rejects_store_with_unknown_visit_or_employee(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/anamneses', [
            'visit_id' => 999999,
            'recorded_by' => 999999,
            'recorded_at' => now()->toDateTimeString(),
        ])->assertStatus(422);
    }

    public function test_it_rejects_per_page_above_limit(): void
    {
        $this->actingUser();

        $this->getJson('/api/v1/anamneses?per_page=500')->assertStatus(422);
    }

    public function test_it_rejects_update_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $record = Anamnesis::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $record->visit_id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);

        $this->putJson("/api/v1/anamneses/{$record->id}", [
            'present_illness_history' => 'Diubah setelah final',
        ])->assertStatus(422);
    }

    public function test_it_rejects_delete_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $record = Anamnesis::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $record->visit_id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);

        $this->deleteJson("/api/v1/anamneses/{$record->id}")->assertStatus(422);
        $this->assertDatabaseHas('anamneses', ['id' => $record->id]);
    }

    public function test_it_allows_update_during_amendment(): void
    {
        $this->actingUser();
        $record = Anamnesis::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $record->visit_id,
            'status' => MedicalRecordEpisode::STATUS_AMENDING,
        ]);

        $this->putJson("/api/v1/anamneses/{$record->id}", [
            'present_illness_history' => 'Koreksi via amendment',
        ])->assertOk();
    }
}
