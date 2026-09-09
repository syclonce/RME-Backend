<?php

namespace Modules\BpjsAntreanRs\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BpjsAntreanRs\Models\BpjsCodeMapping;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class BpjsCodeMappingControllerTest extends TestCase
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
        $user->assignRole('admin');
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    /** Memetakan ward -> kodepoli. */
    public function test_can_create_ward_mapping(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create(['name' => 'Poli Anak']);

        $response = $this->postJson('/api/v1/antrean-rs/bpjs-code-mappings', [
            'ward_id' => $ward->id,
            'bpjs_code' => 'ANA',
            'bpjs_name' => 'Poli Anak',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('antrean_rs_bpjs_code_mappings', [
            'ward_id' => $ward->id,
            'employee_id' => null,
            'bpjs_code' => 'ANA',
            'is_active' => 1,
        ]);
    }

    /** Baris harus memetakan salah satu ward ATAU employee, bukan dua-duanya, bukan tidak sama sekali. */
    public function test_rejects_mapping_with_both_targets(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/antrean-rs/bpjs-code-mappings', [
            'ward_id' => $ward->id,
            'employee_id' => $employee->id,
            'bpjs_code' => 'ANA',
        ]);

        $response->assertUnprocessable();
    }

    public function test_rejects_mapping_with_no_target(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/antrean-rs/bpjs-code-mappings', [
            'bpjs_code' => 'ANA',
        ]);

        $response->assertUnprocessable();
    }

    /** Mengaktifkan pemetaan baru untuk ward yang sama menonaktifkan yang lama, bukan dihapus (riwayat terjaga). */
    public function test_activating_new_mapping_deactivates_old_one_for_same_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $old = BpjsCodeMapping::query()->create([
            'ward_id' => $ward->id,
            'bpjs_code' => 'OLD',
            'is_active' => true,
        ]);

        $response = $this->postJson('/api/v1/antrean-rs/bpjs-code-mappings', [
            'ward_id' => $ward->id,
            'bpjs_code' => 'NEW',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('antrean_rs_bpjs_code_mappings', ['id' => $old->id, 'is_active' => 0]);
        $this->assertDatabaseHas('antrean_rs_bpjs_code_mappings', ['bpjs_code' => 'NEW', 'is_active' => 1]);
    }

    public function test_can_list_update_and_delete_mapping(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $mapping = BpjsCodeMapping::query()->create([
            'ward_id' => $ward->id,
            'bpjs_code' => 'ANA',
            'is_active' => true,
        ]);

        $this->getJson('/api/v1/antrean-rs/bpjs-code-mappings')->assertOk();

        $update = $this->putJson("/api/v1/antrean-rs/bpjs-code-mappings/{$mapping->id}", [
            'bpjs_code' => 'ANA2',
        ]);
        $update->assertOk();
        $this->assertDatabaseHas('antrean_rs_bpjs_code_mappings', ['id' => $mapping->id, 'bpjs_code' => 'ANA2']);

        $this->deleteJson("/api/v1/antrean-rs/bpjs-code-mappings/{$mapping->id}")->assertNoContent();
        $this->assertDatabaseMissing('antrean_rs_bpjs_code_mappings', ['id' => $mapping->id]);
    }
}
