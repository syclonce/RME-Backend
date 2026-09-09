<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class BaepInterventionProtocolControllerTest extends TestCase
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
        $performedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/baep-intervention-protocols', [
            'visit_id' => $visit->id,
            'performed_by' => $performedBy->id,
            'stimulation_ear' => fake()->randomElement(['left','right','bilateral']),
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'in_progress');
        $this->assertDatabaseHas('baep_intervention_protocols', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        BaepInterventionProtocol::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/baep-intervention-protocols');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/baep-intervention-protocols')->assertStatus(401);
    }

    public function test_it_completes_an_in_progress_record(): void
    {
        $this->actingUser();
        $record = BaepInterventionProtocol::factory()->create(['status' => 'in_progress']);

        $this->putJson("/api/v1/baep-intervention-protocols/{$record->id}", [
            'status' => 'completed',
            'interpretation' => 'Normal',
        ])->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_transition_from_terminal_status(): void
    {
        $this->actingUser();
        $record = BaepInterventionProtocol::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/baep-intervention-protocols/{$record->id}", ['status' => 'in_progress'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $record = BaepInterventionProtocol::factory()->create(['status' => 'in_progress']);

        $this->putJson("/api/v1/baep-intervention-protocols/{$record->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    public function test_it_cannot_create_with_status_injected_from_request(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/baep-intervention-protocols', [
            'visit_id' => $visit->id,
            'performed_by' => $performedBy->id,
            'stimulation_ear' => 'left',
            'status' => 'completed',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'in_progress');
    }

    public function test_it_rejects_create_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $visit->id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);
        $performedBy = Employee::factory()->create();

        $this->postJson('/api/v1/baep-intervention-protocols', [
            'visit_id' => $visit->id,
            'performed_by' => $performedBy->id,
            'stimulation_ear' => 'left',
        ])->assertStatus(422);

        $this->assertDatabaseCount('baep_intervention_protocols', 0);
    }
}
