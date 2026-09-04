<?php

namespace Modules\LayananLabOrder\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabOrder\Services\LabOrderService;
use Modules\GeneralWardVisitType\Models\WardVisitType;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class LabOrderControllerTest extends TestCase
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

    public function test_it_creates_lab_order_with_auto_generated_number(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $doctor = Employee::factory()->create();

        $response = $this->postJson('/api/v1/lab-orders', [
            'visit_id' => $visit->id,
            'ordered_by' => $doctor->id,
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('LAB-'.now()->format('Y').'-', $response->json('data.order_number'));
    }

    public function test_it_transitions_status(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create();

        $this->putJson("/api/v1/lab-orders/{$order->id}", ['status' => 'in_progress'])
            ->assertOk()
            ->assertJsonPath('data.status', 'in_progress');

        $this->putJson("/api/v1/lab-orders/{$order->id}", ['status' => 'completed'])
            ->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_skipping_lab_workflow_state(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create(['status' => 'pending']);

        $this->putJson("/api/v1/lab-orders/{$order->id}", ['status' => 'completed'])
            ->assertStatus(422);
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $order = LabOrder::factory()->create();

        $this->putJson("/api/v1/lab-orders/{$order->id}", ['status' => 'teleported'])
            ->assertStatus(422);
    }

    /**
     * Pola legacy: order lab yang DITERIMA melahirkan kunjungan di unit lab,
     * menunjuk balik ke ordernya (padanan `kunjungan.REF` prefix 12).
     */
    public function test_accepting_order_creates_lab_visit(): void
    {
        $user = $this->actingUser();
        $labWard = Ward::factory()->create([
            'visit_type_id' => WardVisitType::query()->where('code', '4')->value('id')
                ?? WardVisitType::create(['name' => 'Laboratorium', 'code' => '4'])->id,
        ]);
        $order = LabOrder::factory()->create(['status' => 'pending']);

        app(LabOrderService::class)->transition($order, 'in_progress', $user);

        $this->assertDatabaseHas('visits', [
            'ward_id' => $labWard->id,
            'origin_type' => LabOrder::class,
            'origin_id' => $order->id,
        ]);
    }

    /** Transisi dapat berulang; kunjungan lab tidak boleh berganda. */
    public function test_repeated_transition_does_not_duplicate_lab_visit(): void
    {
        $user = $this->actingUser();
        Ward::factory()->create([
            'visit_type_id' => WardVisitType::query()->where('code', '4')->value('id')
                ?? WardVisitType::create(['name' => 'Laboratorium', 'code' => '4'])->id,
        ]);
        $order = LabOrder::factory()->create(['status' => 'pending']);
        $service = app(LabOrderService::class);

        $service->transition($order, 'in_progress', $user);
        $service->transition($order->refresh(), 'completed', $user);

        $this->assertSame(1, Visit::query()->where('origin_id', $order->id)->count());
    }
}
