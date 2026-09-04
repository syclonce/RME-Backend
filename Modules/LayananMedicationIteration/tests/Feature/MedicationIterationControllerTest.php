<?php

namespace Modules\LayananMedicationIteration\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananMedicationIteration\Models\MedicationIteration;
use Tests\TestCase;

class MedicationIterationControllerTest extends TestCase
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

    public function test_it_lists_iterations(): void
    {
        $this->actingUser();
        MedicationIteration::factory()->count(3)->create();

        $this->getJson('/api/v1/medication-iterations')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_iteration(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/medication-iterations', [
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory()->create()->id,
            'iteration_number' => 5,
            'quantity' => 5,
            'status' => 'pending',
        ])->assertCreated();

        $this->assertDatabaseCount('medication_iterations', 1);
    }

    public function test_it_shows_iteration(): void
    {
        $this->actingUser();
        $iteration = MedicationIteration::factory()->create();

        $this->getJson("/api/v1/medication-iterations/{$iteration->id}")->assertOk()->assertJsonPath('data.id', $iteration->id);
    }

    public function test_status_cannot_be_injected_on_create(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/medication-iterations', [
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory()->create()->id,
            'iteration_number' => 1,
            'quantity' => 3,
            'status' => 'dispensed',
        ]);

        $response->assertCreated();
        $this->assertSame('pending', $response->json('data.status'));
    }

    public function test_it_transitions_pending_to_dispensed(): void
    {
        $this->actingUser();
        $iteration = MedicationIteration::factory()->create(['status' => 'pending']);

        $this->putJson("/api/v1/medication-iterations/{$iteration->id}", ['status' => 'dispensed'])
            ->assertOk()
            ->assertJsonPath('data.status', 'dispensed');
    }

    public function test_it_rejects_transition_from_dispensed(): void
    {
        $this->actingUser();
        $iteration = MedicationIteration::factory()->create(['status' => 'dispensed']);

        $this->putJson("/api/v1/medication-iterations/{$iteration->id}", ['status' => 'pending'])
            ->assertStatus(422);

        $this->assertSame('dispensed', $iteration->fresh()->status);
    }
}
