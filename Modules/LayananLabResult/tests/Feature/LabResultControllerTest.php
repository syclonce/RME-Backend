<?php

namespace Modules\LayananLabResult\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\LayananLabResult\Models\LabResult;
use Tests\TestCase;

class LabResultControllerTest extends TestCase
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

    public function test_it_records_a_result(): void
    {
        $user = $this->actingUser();
        $order = LabOrder::factory()->create();

        $response = $this->postJson('/api/v1/lab-results', [
            'lab_order_id' => $order->id,
            'test_name' => 'Hemoglobin',
            'result_value' => '13.5',
            'unit' => 'g/dL',
        ]);

        $response->assertCreated()->assertJsonPath('data.test_name', 'Hemoglobin');
        $this->assertDatabaseHas('lab_results', ['lab_order_id' => $order->id, 'recorded_by' => $user->id]);
    }

    public function test_order_shows_its_results(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create();
        $order->results()->create([
            'test_name' => 'Leukosit',
            'result_value' => '7.2',
            'recorded_at' => now(),
        ]);

        $this->getJson("/api/v1/lab-orders/{$order->id}")
            ->assertOk()
            ->assertJsonPath('data.results.0.test_name', 'Leukosit');
    }

    /**
     * Bukti perbaikan: sebelumnya hasil lab bisa ditulis ke kunjungan yang RME
     * -nya sudah final (lubang keamanan yang diaudit - lihat komentar di
     * LabResultController::store()). MedicalRecordGate::assertWritable() kini
     * menolaknya.
     */
    public function test_it_rejects_result_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $order->visit_id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);

        $this->postJson('/api/v1/lab-results', [
            'lab_order_id' => $order->id,
            'test_name' => 'Hemoglobin',
            'result_value' => '13.5',
        ])->assertStatus(422);

        $this->assertDatabaseCount('lab_results', 0);
    }

    /** Order 'cancelled' tidak boleh pernah punya hasil yang sah. */
    public function test_it_rejects_result_when_order_is_cancelled(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create(['status' => 'cancelled']);

        $this->postJson('/api/v1/lab-results', [
            'lab_order_id' => $order->id,
            'test_name' => 'Hemoglobin',
            'result_value' => '13.5',
        ])->assertStatus(422);

        $this->assertDatabaseCount('lab_results', 0);
    }

    /** Order 'completed' juga sudah final - tidak boleh ditambah hasil baru lagi. */
    public function test_it_rejects_result_when_order_is_completed(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create(['status' => 'completed']);

        $this->postJson('/api/v1/lab-results', [
            'lab_order_id' => $order->id,
            'test_name' => 'Hemoglobin',
            'result_value' => '13.5',
        ])->assertStatus(422);

        $this->assertDatabaseCount('lab_results', 0);
    }

    /** Hasil lahir 'final'; klien tidak boleh menyuntik status lain saat mencatat. */
    public function test_status_cannot_be_injected_on_create(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create(['status' => 'in_progress']);

        $this->postJson('/api/v1/lab-results', [
            'lab_order_id' => $order->id,
            'test_name' => 'Hemoglobin',
            'result_value' => '13.5',
            'status' => 'cancelled',
        ])->assertCreated();

        $this->assertDatabaseHas('lab_results', [
            'lab_order_id' => $order->id,
            'status' => 'final',
        ]);
    }

    public function test_valid_transition_is_accepted(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create(['status' => 'in_progress']);
        $result = LabResult::factory()->create(['lab_order_id' => $order->id, 'status' => 'final']);

        $this->postJson("/api/v1/lab-results/{$result->id}/transition", ['status' => 'completed'])
            ->assertOk();

        $this->assertSame('completed', $result->fresh()->status);
    }

    /** Hasil yang sudah ditutup tidak boleh dihidupkan — koreksi lewat hasil baru. */
    public function test_terminal_status_cannot_transition(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create(['status' => 'in_progress']);
        $result = LabResult::factory()->create(['lab_order_id' => $order->id, 'status' => 'completed']);

        $this->postJson("/api/v1/lab-results/{$result->id}/transition", ['status' => 'final'])
            ->assertStatus(422);
    }
}
