<?php

namespace Modules\PembatalanVisitCancellation\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembatalanVisitCancellation\Models\VisitCancellation;
use Tests\TestCase;

class VisitCancellationControllerTest extends TestCase
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

    public function test_it_lists_visit_cancellations(): void
    {
        $this->actingUser();
        VisitCancellation::factory()->count(3)->create();

        $this->getJson('/api/v1/pembatalan-visit-cancellations')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_visit_cancellation(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pembatalan-visit-cancellations', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'cancelled_by' => \Modules\Auth\Models\User::factory()->create()->id,
            'reason' => 'Test description text',
            'cancelled_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('pembatalan_visit_cancellations', 1);
    }

    /** Satu kunjungan satu catatan pembatalan — laporan tidak boleh menghitung ganda. */
    public function test_duplicate_cancellation_is_rejected(): void
    {
        $this->actingUser();
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create();
        $payload = [
            'visit_id' => $visit->id,
            'cancelled_by' => \Modules\Auth\Models\User::factory()->create()->id,
            'reason' => 'Pasien pulang paksa',
            'cancelled_at' => '2026-01-01 08:00:00',
        ];

        $this->postJson('/api/v1/pembatalan-visit-cancellations', $payload)->assertCreated();
        $this->postJson('/api/v1/pembatalan-visit-cancellations', $payload)->assertStatus(422);

        $this->assertDatabaseCount('pembatalan_visit_cancellations', 1);
    }

    /**
     * Port precondition simgos2: kunjungan yang sudah final tidak dibatalkan
     * lewat jalur ini — tagihannya mungkin sudah dikunci.
     */
    public function test_finalized_visit_cannot_be_cancelled(): void
    {
        $this->actingUser();
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create(['status' => 'finalized']);

        $this->postJson('/api/v1/pembatalan-visit-cancellations', [
            'visit_id' => $visit->id,
            'cancelled_by' => \Modules\Auth\Models\User::factory()->create()->id,
            'reason' => 'Terlambat',
            'cancelled_at' => '2026-01-01 08:00:00',
        ])->assertStatus(422);
    }
}
