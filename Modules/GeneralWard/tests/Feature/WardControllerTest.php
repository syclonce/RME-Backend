<?php

namespace Modules\GeneralWard\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\GeneralWardVisitType\Models\WardVisitType;
use Tests\TestCase;

class WardControllerTest extends TestCase
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

    public function test_it_lists_wards(): void
    {
        $this->actingUser();
        Ward::factory()->count(2)->create();

        $this->getJson('/api/v1/wards')->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_exposes_visit_type_and_emergency_flag_for_registration(): void
    {
        $this->actingUser();
        $type = WardVisitType::factory()->create([
            'name' => 'Gawat Darurat',
            'triggers_emergency_flag' => true,
        ]);
        Ward::factory()->create(['name' => 'IGD', 'visit_type_id' => $type->id]);

        $this->getJson('/api/v1/wards?per_page=100')
            ->assertOk()
            ->assertJsonPath('data.0.visit_type_name', 'Gawat Darurat')
            ->assertJsonPath('data.0.triggers_emergency', true);
    }

    public function test_it_creates_ward(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/wards', ['name' => 'IGD'])
            ->assertCreated()
            ->assertJsonPath('name', 'IGD');
    }

    public function test_it_deletes_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->deleteJson("/api/v1/wards/{$ward->id}")->assertStatus(204);
    }
}
