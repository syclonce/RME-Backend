<?php

namespace Modules\LayananRadiologyOrder\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;
use Modules\LayananRadiologyOrder\Services\RadiologyOrderService;
use Modules\GeneralWardVisitType\Models\WardVisitType;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class RadiologyOrderControllerTest extends TestCase
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

    public function test_it_lists_rad_orders(): void
    {
        $this->actingUser();
        RadiologyOrder::factory()->count(3)->create();

        $this->getJson('/api/v1/radiology-orders')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_rad_order_with_status_forced_to_pending(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/radiology-orders', [
            'visit_id' => Visit::factory()->create()->id,
            'patient_id' => Patient::factory()->create()->id,
            'ordered_at' => '2026-01-01 08:00:00',
            // status sengaja tidak dikirim: harus selalu 'pending' meski
            // klien mencoba menyuntik nilai lain (lihat komentar
            // StoreRadiologyOrderRequest) — request tidak lagi punya field status.
        ])->assertCreated();

        $this->assertSame('pending', $response->json('data.status'));
        $this->assertDatabaseCount('radiology_orders', 1);
    }

    public function test_it_shows_rad_order(): void
    {
        $this->actingUser();
        $rad_order = RadiologyOrder::factory()->create();

        $this->getJson("/api/v1/radiology-orders/{$rad_order->id}")->assertOk()->assertJsonPath('data.id', $rad_order->id);
    }

    public function test_it_transitions_status(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create(['status' => 'pending']);

        $this->putJson("/api/v1/radiology-orders/{$order->id}", ['status' => 'in_progress'])
            ->assertOk()
            ->assertJsonPath('data.status', 'in_progress');

        $this->putJson("/api/v1/radiology-orders/{$order->id}", ['status' => 'completed'])
            ->assertOk()
            ->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_skipping_radiology_workflow_state(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create(['status' => 'pending']);

        $this->putJson("/api/v1/radiology-orders/{$order->id}", ['status' => 'completed'])
            ->assertStatus(422);
    }

    public function test_it_rejects_transition_from_terminal_status(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/radiology-orders/{$order->id}", ['status' => 'in_progress'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create();

        $this->putJson("/api/v1/radiology-orders/{$order->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    // --- Tes di bawah ini membuktikan penyerapan fitur LayananImagingOrder
    // (keputusan pemilik repo 2026-09-04) berfungsi di atas RadiologyOrder. ---

    public function test_it_creates_order_with_modality_and_body_part(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/radiology-orders', [
            'visit_id' => Visit::factory()->create()->id,
            'patient_id' => Patient::factory()->create()->id,
            'modality' => 'CT',
            'body_part' => 'Thorax',
            'ordered_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertSame('CT', $response->json('data.modality'));
        $this->assertSame('Thorax', $response->json('data.body_part'));
    }

    public function test_index_filters_by_status_and_modality(): void
    {
        $this->actingUser();

        RadiologyOrder::factory()->create(['modality' => 'CT', 'status' => 'pending']);
        RadiologyOrder::factory()->create(['modality' => 'MRI', 'status' => 'completed']);

        $this->getJson('/api/v1/radiology-orders?modality=CT')->assertOk()->assertJsonCount(1, 'data');
        $this->getJson('/api/v1/radiology-orders?status=completed')->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_schedule_moves_order_to_scheduled_status(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create(['status' => 'pending']);

        $this->postJson("/api/v1/radiology-orders/{$order->id}/schedule", [
            'scheduled_at' => '2026-01-02 09:00:00',
        ])->assertOk()->assertJsonPath('data.status', 'scheduled');

        $this->assertDatabaseHas('radiology_orders', ['id' => $order->id, 'status' => 'scheduled']);
    }

    public function test_schedule_rejects_completed_order(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->completed()->create();

        $this->postJson("/api/v1/radiology-orders/{$order->id}/schedule", [
            'scheduled_at' => '2026-01-02 09:00:00',
        ])->assertStatus(422);
    }

    public function test_cancel_moves_order_to_cancelled_status(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create(['status' => 'pending']);

        $this->postJson("/api/v1/radiology-orders/{$order->id}/cancel")
            ->assertOk()
            ->assertJsonPath('data.status', 'cancelled');
    }

    public function test_cancel_rejects_completed_order(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->completed()->create();

        $this->postJson("/api/v1/radiology-orders/{$order->id}/cancel")->assertStatus(422);
    }

    /**
     * Order radiologi yang mulai DIKERJAKAN melahirkan kunjungan di unit radiologi
     * (padanan `kunjungan.REF` prefix 13 legacy). Tanpa ini pelayanan radiologi
     * menumpang kunjungan poli pengirim dan tagihannya tidak terpisah per unit.
     */
    public function test_starting_order_creates_radiology_visit(): void
    {
        $user = $this->actingUser();
        $radWard = Ward::factory()->create([
            'visit_type_id' => WardVisitType::query()->where('code', '5')->value('id')
                ?? WardVisitType::create(['name' => 'Radiologi', 'code' => '5'])->id,
        ]);
        $order = RadiologyOrder::factory()->create(['status' => 'pending']);

        app(RadiologyOrderService::class)->transition($order, 'in_progress', $user);

        $this->assertDatabaseHas('visits', [
            'ward_id' => $radWard->id,
            'origin_type' => RadiologyOrder::class,
            'origin_id' => $order->id,
        ]);
    }

    /** Dijadwalkan belum berarti diterima — kunjungan belum terbit. */
    public function test_scheduling_does_not_create_visit_yet(): void
    {
        $user = $this->actingUser();
        Ward::factory()->create([
            'visit_type_id' => WardVisitType::query()->where('code', '5')->value('id')
                ?? WardVisitType::create(['name' => 'Radiologi', 'code' => '5'])->id,
        ]);
        $order = RadiologyOrder::factory()->create(['status' => 'pending']);

        app(RadiologyOrderService::class)->transition($order, 'scheduled', $user);

        $this->assertSame(0, Visit::query()->where('origin_id', $order->id)
            ->where('origin_type', RadiologyOrder::class)->count());
    }
}
