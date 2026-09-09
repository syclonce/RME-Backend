<?php

namespace Modules\GeneralFacilityMaintenance\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralFacilityMaintenance\Models\MaintenanceAsset;
use Tests\TestCase;

class MaintenanceAssetControllerTest extends TestCase
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

    public function test_it_creates_maintenance_asset(): void
    {
        $this->actingUser();
        $userId = \Modules\Auth\Models\User::query()->latest('id')->value('id');
        \Modules\GeneralEmployee\Models\Employee::factory()->create(['user_id' => $userId]);

        $this->postJson('/api/v1/maintenance-assets', [
            'asset_code' => 'AST-001',
            'asset_name' => 'AC Ruang Rawat Inap 1',
            'location' => 'Gedung A Lantai 2',
        ])
            ->assertCreated()
            ->assertJsonPath('asset_code', 'AST-001')
            ->assertJsonPath('status', 'operational');
    }

    public function test_it_lists_maintenance_assets(): void
    {
        $this->actingUser();
        MaintenanceAsset::factory()->count(3)->create();

        $this->getJson('/api/v1/maintenance-assets')
            ->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
