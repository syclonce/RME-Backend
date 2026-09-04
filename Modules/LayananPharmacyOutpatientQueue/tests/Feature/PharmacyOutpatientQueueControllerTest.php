<?php

namespace Modules\LayananPharmacyOutpatientQueue\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPharmacyOutpatientQueue\Models\PharmacyOutpatientQueue;
use Tests\TestCase;

class PharmacyOutpatientQueueControllerTest extends TestCase
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

    public function test_it_lists_queues(): void
    {
        $this->actingUser();
        PharmacyOutpatientQueue::factory()->count(3)->create();

        $this->getJson('/api/v1/pharmacy-outpatient-queues')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_queue(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pharmacy-outpatient-queues', [
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory()->create()->id,
            'queue_number' => 'Test Queue_number',
            'status' => 'waiting',
        ])->assertCreated();

        $this->assertDatabaseCount('pharmacy_outpatient_queues', 1);
    }

    public function test_it_shows_queue(): void
    {
        $this->actingUser();
        $queue = PharmacyOutpatientQueue::factory()->create();

        $this->getJson("/api/v1/pharmacy-outpatient-queues/{$queue->id}")->assertOk()->assertJsonPath('data.id', $queue->id);
    }

    public function test_status_cannot_be_injected_on_create(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/pharmacy-outpatient-queues', [
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory()->create()->id,
            'queue_number' => 'Q-001',
            'status' => 'done',
        ]);

        $response->assertCreated();
        $this->assertSame('waiting', $response->json('data.status'));
    }

    public function test_it_transitions_waiting_to_called_to_done(): void
    {
        $this->actingUser();
        $queue = PharmacyOutpatientQueue::factory()->create(['status' => 'waiting']);

        $this->putJson("/api/v1/pharmacy-outpatient-queues/{$queue->id}", ['status' => 'called'])
            ->assertOk()
            ->assertJsonPath('data.status', 'called');

        $this->putJson("/api/v1/pharmacy-outpatient-queues/{$queue->id}", ['status' => 'done'])
            ->assertOk()
            ->assertJsonPath('data.status', 'done');
    }

    public function test_it_rejects_done_without_being_called_first(): void
    {
        $this->actingUser();
        $queue = PharmacyOutpatientQueue::factory()->create(['status' => 'waiting']);

        $this->putJson("/api/v1/pharmacy-outpatient-queues/{$queue->id}", ['status' => 'done'])
            ->assertStatus(422);

        $this->assertSame('waiting', $queue->fresh()->status);
    }
}
