<?php

namespace Modules\LayananPathologyAnatomyResult\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult;
use Tests\TestCase;

class PathologyAnatomyResultControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }
    private function actingUser(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');
    }

    public function test_it_lists_pa_results(): void
    {
        $this->actingUser();
        PathologyAnatomyResult::factory()->count(3)->create();

        $this->getJson('/api/v1/pathology-anatomy-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_pa_result(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/pathology-anatomy-results', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'specimen_description' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
        $this->assertDatabaseCount('pathology_anatomy_results', 1);
    }

    public function test_status_is_ignored_on_create(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/pathology-anatomy-results', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'specimen_description' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
            'status' => 'final',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
    }

    public function test_it_shows_pa_result(): void
    {
        $this->actingUser();
        $pa_result = PathologyAnatomyResult::factory()->create();

        $this->getJson("/api/v1/pathology-anatomy-results/{$pa_result->id}")->assertOk()->assertJsonPath('data.id', $pa_result->id);
    }

    public function test_it_transitions_pending_to_final(): void
    {
        $this->actingUser();
        $pa_result = PathologyAnatomyResult::factory()->create(['status' => 'pending']);

        $this->putJson("/api/v1/pathology-anatomy-results/{$pa_result->id}", ['status' => 'final'])
            ->assertOk()->assertJsonPath('data.status', 'final');

        $this->assertDatabaseHas('pathology_anatomy_results', ['id' => $pa_result->id, 'status' => 'final']);
    }

    public function test_it_rejects_invalid_transition(): void
    {
        $this->actingUser();
        $pa_result = PathologyAnatomyResult::factory()->create(['status' => 'final']);

        $this->putJson("/api/v1/pathology-anatomy-results/{$pa_result->id}", ['status' => 'pending'])
            ->assertStatus(422);
    }

}
