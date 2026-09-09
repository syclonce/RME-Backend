<?php

namespace Modules\InventoryStockOpname\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryStockOpname\Models\StockOpname;
use Tests\TestCase;

class InventoryStockOpnameControllerTest extends TestCase
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

    public function test_it_lists_stock_opnames(): void
    {
        $this->actingUser();
        StockOpname::factory()->count(3)->create();

        $this->getJson('/api/v1/inventorystockopnames')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_stock_opname_in_progress(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/inventorystockopnames', [
            'ward_id' => $ward->id,
            'opname_date' => now()->toDateString(),
            'conducted_by' => $employee->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'in_progress');
        $this->assertDatabaseHas('stock_opnames', ['ward_id' => $ward->id, 'conducted_by' => $employee->id]);
    }

    public function test_it_rejects_missing_conducted_by(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/inventorystockopnames', ['ward_id' => $ward->id, 'opname_date' => now()->toDateString()])
            ->assertStatus(422);
    }

    public function test_it_completes_stock_opname(): void
    {
        $this->actingUser();
        $opname = StockOpname::factory()->create(['status' => 'in_progress']);

        $this->putJson("/api/v1/inventorystockopnames/{$opname->id}", ['status' => 'completed'])
            ->assertOk()
            ->assertJsonPath('data.status', 'completed');
    }

    public function test_it_rejects_reopening_a_completed_opname(): void
    {
        $this->actingUser();
        $opname = StockOpname::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/inventorystockopnames/{$opname->id}", ['status' => 'cancelled'])
            ->assertStatus(422);
    }

    public function test_status_cannot_be_injected_at_create(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/inventorystockopnames', [
            'ward_id' => $ward->id,
            'opname_date' => now()->toDateString(),
            'conducted_by' => $employee->id,
            'status' => 'completed',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'in_progress');
    }

    public function test_guest_cannot_access_stock_opnames(): void
    {
        $this->getJson('/api/v1/inventorystockopnames')->assertStatus(401);
    }
}
