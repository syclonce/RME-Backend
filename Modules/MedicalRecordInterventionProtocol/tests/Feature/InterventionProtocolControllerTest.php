<?php

namespace Modules\MedicalRecordInterventionProtocol\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\MedicalRecordInterventionProtocol\Models\InterventionProtocol;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class InterventionProtocolControllerTest extends TestCase
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
        $startedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/intervention-protocols', [
            'visit_id' => $visit->id,
            'started_by' => $startedBy->id,
            'protocol_name' => fake()->words(3,true),
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'active');
        $this->assertDatabaseHas('intervention_protocols', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        InterventionProtocol::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/intervention-protocols');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/intervention-protocols')->assertStatus(401);
    }

    public function test_it_completes_an_active_protocol(): void
    {
        $this->actingUser();
        $record = InterventionProtocol::factory()->create(['status' => 'active']);

        $this->putJson("/api/v1/intervention-protocols/{$record->id}", ['status' => 'completed'])
            ->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_can_discontinue_an_active_protocol(): void
    {
        $this->actingUser();
        $record = InterventionProtocol::factory()->create(['status' => 'active']);

        $this->putJson("/api/v1/intervention-protocols/{$record->id}", ['status' => 'discontinued'])
            ->assertOk()->assertJsonPath('data.status', 'discontinued');
    }

    public function test_it_rejects_transition_from_terminal_status(): void
    {
        $this->actingUser();
        $record = InterventionProtocol::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/intervention-protocols/{$record->id}", ['status' => 'active'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $record = InterventionProtocol::factory()->create(['status' => 'active']);

        $this->putJson("/api/v1/intervention-protocols/{$record->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    public function test_it_cannot_create_with_status_injected_from_request(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $startedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/intervention-protocols', [
            'visit_id' => $visit->id,
            'started_by' => $startedBy->id,
            'protocol_name' => fake()->words(3, true),
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
        $startedBy = Employee::factory()->create();

        $this->postJson('/api/v1/intervention-protocols', [
            'visit_id' => $visit->id,
            'started_by' => $startedBy->id,
            'protocol_name' => fake()->words(3, true),
        ])->assertStatus(422);

        $this->assertDatabaseCount('intervention_protocols', 0);
    }
}
