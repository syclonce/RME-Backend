<?php

namespace Modules\MedicalRecordFluidBalanceAssessment\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordFluidBalanceAssessment\Models\FluidBalanceAssessment;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class FluidBalanceAssessmentControllerTest extends TestCase
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
            'assessed_at' => now()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/v1/fluid-balance-assessments', $payload);

        $response->assertCreated();
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        FluidBalanceAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/fluid-balance-assessments');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = FluidBalanceAssessment::factory()->create();

        $response = $this->getJson("/api/v1/fluid-balance-assessments/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = FluidBalanceAssessment::factory()->create();

        $response = $this->putJson("/api/v1/fluid-balance-assessments/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = FluidBalanceAssessment::factory()->create();

        $response = $this->deleteJson("/api/v1/fluid-balance-assessments/{$record->id}");

        $response->assertNoContent();
    }
}
