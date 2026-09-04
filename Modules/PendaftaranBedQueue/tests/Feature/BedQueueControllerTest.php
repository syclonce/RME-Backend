<?php

namespace Modules\PendaftaranBedQueue\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranBedQueue\Models\BedQueue;
use Tests\TestCase;

class BedQueueControllerTest extends TestCase
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

    public function test_it_creates_a_bed_queue_entry(): void
    {
        $this->actingUser();
        $bed = Bed::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/bed-queues', [
            'bed_id' => $bed->id,
            'patient_id' => $patient->id,
            'queue_number' => 2,
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.status', 'waiting');
    }

    public function test_it_lists_queues_filtered_by_bed(): void
    {
        $this->actingUser();
        $bed = Bed::factory()->create();
        BedQueue::factory()->count(2)->create(['bed_id' => $bed->id]);
        BedQueue::factory()->create();

        $response = $this->getJson("/api/v1/bed-queues?bed_id={$bed->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_updates_queue_status(): void
    {
        $this->actingUser();
        $queue = BedQueue::factory()->create(['status' => 'waiting']);

        $response = $this->putJson("/api/v1/bed-queues/{$queue->id}", ['status' => 'assigned']);

        $response->assertOk()->assertJsonPath('data.status', 'assigned');
    }

    public function test_guest_cannot_access_bed_queues(): void
    {
        $this->getJson('/api/v1/bed-queues')->assertStatus(401);
    }

    public function test_status_cannot_be_injected_on_create(): void
    {
        $this->actingUser();
        $bed = Bed::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/bed-queues', [
            'bed_id' => $bed->id,
            'patient_id' => $patient->id,
            'queue_number' => 1,
            'status' => 'assigned',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'waiting');
    }

    public function test_it_rejects_invalid_transition_from_assigned_to_waiting(): void
    {
        $this->actingUser();
        $queue = BedQueue::factory()->create(['status' => 'assigned']);

        $this->putJson("/api/v1/bed-queues/{$queue->id}", ['status' => 'waiting'])
            ->assertStatus(422);

        $this->assertSame('assigned', $queue->fresh()->status);
    }

    public function test_it_can_cancel_a_waiting_queue(): void
    {
        $this->actingUser();
        $queue = BedQueue::factory()->create(['status' => 'waiting']);

        $this->putJson("/api/v1/bed-queues/{$queue->id}", ['status' => 'cancelled'])
            ->assertOk()
            ->assertJsonPath('data.status', 'cancelled');
    }

    public function test_it_rejects_transition_from_final_status(): void
    {
        $this->actingUser();
        $queue = BedQueue::factory()->create(['status' => 'cancelled']);

        $this->putJson("/api/v1/bed-queues/{$queue->id}", ['status' => 'assigned'])
            ->assertStatus(422);
    }
}
