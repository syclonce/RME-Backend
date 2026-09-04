<?php

namespace Modules\LayananCriticalLabValue\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananCriticalLabValue\Models\CriticalLabValue;
use Modules\LayananLabOrder\Models\LabOrder;
use Tests\TestCase;

class CriticalLabValueControllerTest extends TestCase
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

    public function test_it_lists_critical_values(): void
    {
        $this->actingUser();
        CriticalLabValue::factory()->count(3)->create();

        $this->getJson('/api/v1/critical-lab-values')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_critical_value_unnotified_and_unacknowledged(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/critical-lab-values', [
            'lab_order_id' => LabOrder::factory()->create()->id,
            'parameter_name' => 'Kalium',
            'critical_value' => '7.0 mmol/L',
        ])->assertCreated();

        $this->assertNull($response->json('data.notified_at'));
        $this->assertFalse($response->json('data.acknowledged'));
        $this->assertDatabaseCount('critical_lab_values', 1);
    }

    public function test_it_shows_critical_value(): void
    {
        $this->actingUser();
        $critical_value = CriticalLabValue::factory()->create();

        $this->getJson("/api/v1/critical-lab-values/{$critical_value->id}")->assertOk()->assertJsonPath('data.id', $critical_value->id);
    }

    public function test_it_marks_critical_value_as_notified(): void
    {
        $user = $this->actingUser();
        $value = CriticalLabValue::factory()->create([
            'notified_at' => null,
            'notified_by' => null,
            'acknowledged' => false,
        ]);

        $response = $this->postJson("/api/v1/critical-lab-values/{$value->id}/notify", [
            'notified_to' => 'dr. Budi (via telepon)',
        ])->assertOk();

        $this->assertSame('dr. Budi (via telepon)', $response->json('data.notified_to'));
        $this->assertNotNull($response->json('data.notified_at'));
        $this->assertSame($user->id, $response->json('data.notified_by'));
    }

    public function test_it_rejects_acknowledge_before_notified(): void
    {
        $this->actingUser();
        $value = CriticalLabValue::factory()->create([
            'notified_at' => null,
            'notified_by' => null,
            'acknowledged' => false,
        ]);

        $this->postJson("/api/v1/critical-lab-values/{$value->id}/acknowledge")
            ->assertStatus(422);

        $this->assertFalse($value->refresh()->acknowledged);
    }

    public function test_it_acknowledges_critical_value_after_notified(): void
    {
        $user = $this->actingUser();
        $value = CriticalLabValue::factory()->create([
            'notified_at' => now(),
            'acknowledged' => false,
        ]);

        $response = $this->postJson("/api/v1/critical-lab-values/{$value->id}/acknowledge")
            ->assertOk();

        $this->assertTrue($response->json('data.acknowledged'));
        $this->assertSame($user->id, $response->json('data.acknowledged_by'));
        $this->assertNotNull($response->json('data.acknowledged_at'));
    }

    public function test_it_rejects_double_acknowledge(): void
    {
        $this->actingUser();
        $value = CriticalLabValue::factory()->create([
            'notified_at' => now(),
            'acknowledged' => true,
            'acknowledged_at' => now(),
        ]);

        $this->postJson("/api/v1/critical-lab-values/{$value->id}/acknowledge")
            ->assertStatus(422);
    }

    public function test_it_filters_unacknowledged_critical_values_as_worklist(): void
    {
        $this->actingUser();
        CriticalLabValue::factory()->count(2)->create(['acknowledged' => false]);
        CriticalLabValue::factory()->count(3)->create([
            'acknowledged' => true,
            'notified_at' => now(),
            'acknowledged_at' => now(),
        ]);

        $this->getJson('/api/v1/critical-lab-values?unacknowledged=1')
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }
}
