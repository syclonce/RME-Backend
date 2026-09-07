<?php

namespace Modules\MedicalRecordCppt\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordCppt\Models\CpptEntry;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class CpptControllerTest extends TestCase
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

    public function test_mencatat_cppt_append_only(): void
    {
        $user = $this->actingUser();
        $employee = Employee::factory()->create(['user_id' => $user->id]);
        $visit = Visit::factory()->create();

        $response = $this->postJson('/api/v1/cppt-entries', [
            'visit_id' => $visit->id,
            'subjective' => 'Nyeri perut kanan bawah',
            'objective' => 'TD 120/80, McBurney +',
            'assessment' => 'Suspek appendicitis',
            'plan' => 'Konsul bedah',
            'profession' => 'dokter',
        ]);

        $response->assertCreated()->assertJsonPath('data.recorded_by', $employee->id);
        $this->assertDatabaseCount('cppt_entries', 1);
    }

    public function test_tanpa_rute_update_delete(): void
    {
        $this->actingUser();
        $entry = CpptEntry::factory()->create();

        $this->putJson("/api/v1/cppt-entries/{$entry->id}", ['plan' => 'Diubah'])->assertStatus(405);
        $this->deleteJson("/api/v1/cppt-entries/{$entry->id}")->assertStatus(405);
    }

    public function test_hanya_dpjp_yang_bisa_verifikasi(): void
    {
        $dpjpUser = $this->actingUser();
        $dpjp = Employee::factory()->create(['user_id' => $dpjpUser->id]);
        $visit = Visit::factory()->create(['attending_physician_id' => $dpjp->id]);

        $this->postJson('/api/v1/cppt-verifications', [
            'visit_id' => $visit->id,
            'valid_until' => now()->addDay()->toDateString(),
        ])->assertCreated()->assertJsonPath('data.status', 'verified');
    }

    public function test_bukan_dpjp_ditolak_verifikasi(): void
    {
        $user = $this->actingUser();
        Employee::factory()->create(['user_id' => $user->id]);
        $otherDoctor = Employee::factory()->create();
        $visit = Visit::factory()->create(['attending_physician_id' => $otherDoctor->id]);

        $this->postJson('/api/v1/cppt-verifications', [
            'visit_id' => $visit->id,
            'valid_until' => now()->addDay()->toDateString(),
        ])->assertForbidden();

        $this->assertDatabaseCount('cppt_verifications', 0);
    }

    public function test_verifikasi_ganda_periode_sama_ditolak(): void
    {
        $user = $this->actingUser();
        $dpjp = Employee::factory()->create(['user_id' => $user->id]);
        $visit = Visit::factory()->create(['attending_physician_id' => $dpjp->id]);
        $until = now()->addDay()->toDateString();

        $this->postJson('/api/v1/cppt-verifications', [
            'visit_id' => $visit->id, 'valid_until' => $until,
        ])->assertCreated();

        $this->postJson('/api/v1/cppt-verifications', [
            'visit_id' => $visit->id, 'valid_until' => $until,
        ])->assertUnprocessable();
    }
}
