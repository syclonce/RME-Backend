<?php

namespace Tests\Feature\Concerns;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

/**
 * `recorded_at` di 12 modul rekam medis sebelumnya `['required', 'date']` —
 * wajib dikirim klien, tanpa batas atas.
 *
 * Dua akibatnya: petugas harus mengetik waktu yang sebenarnya sudah diketahui
 * server, dan catatan bertanggal masa depan dapat tersimpan ke rekam medis
 * yang append-only.
 */
class RecordedAtTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    private function actingUserWithEmployee(): User
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        Employee::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_recorded_at_is_filled_by_server_when_omitted(): void
    {
        $this->actingUserWithEmployee();
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/anamneses', [
            'visit_id' => $visit->id,
            'present_illness_history' => 'Demam tiga hari.',
        ])->assertCreated();

        $record = \DB::table('anamneses')->where('visit_id', $visit->id)->first();
        $this->assertNotNull($record->recorded_at);
    }

    /**
     * Catatan bertanggal masa depan tidak dapat dikoreksi belakangan — rekam
     * medis ini append-only. Ditolak saat masuk.
     */
    public function test_it_rejects_a_future_recorded_at(): void
    {
        $this->actingUserWithEmployee();
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/anamneses', [
            'visit_id' => $visit->id,
            'present_illness_history' => 'Dicatat dari masa depan.',
            'recorded_at' => now()->addDay()->toDateTimeString(),
        ])->assertStatus(422)->assertJsonValidationErrors('recorded_at');

        $this->assertDatabaseCount('anamneses', 0);
    }

    /** Waktu lampau tetap diterima: pencatatan susulan adalah hal biasa. */
    public function test_it_accepts_a_past_recorded_at(): void
    {
        $this->actingUserWithEmployee();
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/anamneses', [
            'visit_id' => $visit->id,
            'present_illness_history' => 'Dicatat menyusul sore harinya.',
            'recorded_at' => now()->subHours(3)->toDateTimeString(),
        ])->assertCreated();
    }
}
