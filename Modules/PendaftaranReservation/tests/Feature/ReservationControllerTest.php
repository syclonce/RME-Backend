<?php

namespace Modules\PendaftaranReservation\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranReservation\Models\Reservation;
use Tests\TestCase;

class ReservationControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
        $this->user = User::factory()->create();
        $this->user->assignRole('petugas');
    }

    public function test_can_list_reservations(): void
    {
        Reservation::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/v1/reservations');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_reservation(): void
    {
        $patient = Patient::factory()->create();
        $ward = Ward::factory()->create();

        $data = [
            'patient_id' => $patient->id,
            'ward_id' => $ward->id,
            'reserved_at' => now()->toDateTimeString(),
            'scheduled_at' => now()->addDays(2)->toDateTimeString(),
        ];

        $response = $this->actingAs($this->user)->postJson('/api/v1/reservations', $data);

        $response->assertCreated()
            ->assertJsonPath('data.status', 'pending');

        $this->assertDatabaseHas('reservations', $data);
    }

    public function test_can_show_reservation(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/reservations/{$reservation->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $reservation->id);
    }

    public function test_can_update_reservation_status(): void
    {
        $reservation = Reservation::factory()->create(['status' => 'pending']);

        $data = [
            'status' => 'confirmed',
        ];

        $response = $this->actingAs($this->user)->putJson("/api/v1/reservations/{$reservation->id}", $data);

        $response->assertOk()
            ->assertJsonPath('data.status', 'confirmed');

        $this->assertDatabaseHas('reservations', [
            'id' => $reservation->id,
            'status' => 'confirmed',
        ]);
    }

    public function test_status_cannot_be_injected_on_create(): void
    {
        $patient = Patient::factory()->create();
        $ward = Ward::factory()->create();

        $response = $this->actingAs($this->user)->postJson('/api/v1/reservations', [
            'patient_id' => $patient->id,
            'ward_id' => $ward->id,
            'reserved_at' => now()->toDateTimeString(),
            'scheduled_at' => now()->addDays(2)->toDateTimeString(),
            'status' => 'confirmed',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
    }

    public function test_confirmed_can_transition_to_completed(): void
    {
        $reservation = Reservation::factory()->create(['status' => 'confirmed']);

        $this->actingAs($this->user)
            ->putJson("/api/v1/reservations/{$reservation->id}", ['status' => 'completed'])
            ->assertOk()
            ->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_invalid_transition_from_pending_to_completed(): void
    {
        $reservation = Reservation::factory()->create(['status' => 'pending']);

        $this->actingAs($this->user)
            ->putJson("/api/v1/reservations/{$reservation->id}", ['status' => 'completed'])
            ->assertStatus(422);

        $this->assertSame('pending', $reservation->fresh()->status);
    }

    public function test_it_rejects_transition_from_final_status(): void
    {
        $reservation = Reservation::factory()->create(['status' => 'cancelled']);

        $this->actingAs($this->user)
            ->putJson("/api/v1/reservations/{$reservation->id}", ['status' => 'confirmed'])
            ->assertStatus(422);
    }
}
