<?php

namespace Modules\LayananRadiologyResult\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;
use Modules\LayananRadiologyResult\Models\RadiologyResult;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Tests\TestCase;

class RadiologyResultControllerTest extends TestCase
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

    public function test_it_lists_rad_results(): void
    {
        $this->actingUser();
        RadiologyResult::factory()->count(3)->create();

        $this->getJson('/api/v1/radiology-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_rad_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/radiology-results', [
            'radiology_order_id' => \Modules\LayananRadiologyOrder\Models\RadiologyOrder::factory()->create()->id,
            'findings' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
            'status' => 'pending',
        ])->assertCreated();

        $this->assertDatabaseCount('radiology_results', 1);
    }

    public function test_it_shows_rad_result(): void
    {
        $this->actingUser();
        $rad_result = RadiologyResult::factory()->create();

        $this->getJson("/api/v1/radiology-results/{$rad_result->id}")->assertOk()->assertJsonPath('data.id', $rad_result->id);
    }

    /**
     * Bukti perbaikan: sebelumnya route ini hanya dijaga auth:sanctum dan
     * StoreRadiologyResultRequest::authorize() selalu true, jadi hasil radiologi
     * bisa ditulis ke kunjungan yang RME-nya sudah final. Kini ditolak lewat
     * MedicalRecordGate::assertWritable() (lihat RadiologyResultController::store()).
     */
    public function test_it_rejects_result_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $order->visit_id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);

        $this->postJson('/api/v1/radiology-results', [
            'radiology_order_id' => $order->id,
            'findings' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
            'status' => 'pending',
        ])->assertStatus(422);

        $this->assertDatabaseCount('radiology_results', 0);
    }

    /** Order 'cancelled' tidak boleh pernah punya hasil yang sah. */
    public function test_it_rejects_result_when_order_is_cancelled(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create(['status' => 'cancelled']);

        $this->postJson('/api/v1/radiology-results', [
            'radiology_order_id' => $order->id,
            'findings' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
            'status' => 'pending',
        ])->assertStatus(422);

        $this->assertDatabaseCount('radiology_results', 0);
    }

    /** Order 'completed' juga sudah final - tidak boleh ditambah hasil baru lagi. */
    public function test_it_rejects_result_when_order_is_completed(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create(['status' => 'completed']);

        $this->postJson('/api/v1/radiology-results', [
            'radiology_order_id' => $order->id,
            'findings' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
            'status' => 'pending',
        ])->assertStatus(422);

        $this->assertDatabaseCount('radiology_results', 0);
    }

    /**
     * Auto-complete (diserap dari ImagingStudyService::record(), keputusan
     * pemilik repo 2026-09-04): hasil berstatus 'final' menyelesaikan order
     * yang masih pending, lewat RadiologyOrderService::transition() bertahap
     * (pending → in_progress → completed) — lihat RadiologyResultController::store().
     */
    public function test_final_result_auto_completes_pending_order(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create(['status' => 'pending']);

        $this->postJson('/api/v1/radiology-results', [
            'radiology_order_id' => $order->id,
            'findings' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
            'status' => 'final',
            'report_url' => '/storage/radiology/reports/1.pdf',
        ])->assertCreated();

        $this->assertDatabaseHas('radiology_orders', ['id' => $order->id, 'status' => 'completed']);
    }

    /** Hasil 'pending' (draf) TIDAK memicu auto-complete order. */
    public function test_pending_result_does_not_auto_complete_order(): void
    {
        $this->actingUser();
        $order = RadiologyOrder::factory()->create(['status' => 'pending']);

        $this->postJson('/api/v1/radiology-results', [
            'radiology_order_id' => $order->id,
            'findings' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
            'status' => 'pending',
        ])->assertCreated();

        $this->assertDatabaseHas('radiology_orders', ['id' => $order->id, 'status' => 'pending']);
    }
}
