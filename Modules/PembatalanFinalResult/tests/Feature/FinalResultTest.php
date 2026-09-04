<?php
namespace Modules\PembatalanFinalResult\Tests\Feature;
use Tests\TestCase;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PembatalanFinalResult\Models\FinalResult;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\Auth\Models\User;
use App\Modules\Contracts\MedicalRecordGate;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
class FinalResultTest extends TestCase {
    use RefreshDatabase;

    private User $user;
    protected function setUp(): void {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
        $this->user = User::factory()->create();
        $this->user->assignRole('petugas');
        $this->actingAs($this->user, 'sanctum');
    }
    public function test_can_list() {
        FinalResult::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/final-results');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }
    /**
     * Membatalkan final hasil HARUS membuka kembali RME kunjungannya --
     * itulah padanan trigger legacy `SET FINAL_HASIL = 0`. Sebelum perbaikan
     * ini, barisnya tersimpan tapi RME tetap terkunci: catatan yang mengaku
     * membatalkan sesuatu tanpa membatalkan apa pun.
     */
    public function test_creating_a_cancellation_reopens_the_medical_record() {
        $visit = Visit::factory()->create();
        $gate = app(MedicalRecordGate::class);
        $gate->start($visit->id, $this->user);

        // Finalisasi menuntut catatan klinis + diagnosis utama
        // (EncounterFinalizationRule); tanpa itu RME tidak pernah jadi final,
        // dan tidak ada yang bisa dibatalkan.
        ClinicalNote::factory()->create(['visit_id' => $visit->id]);
        Diagnosis::factory()->primary()->create(['visit_id' => $visit->id]);

        $gate->finalize($visit->id, $this->user);

        $this->assertSame('finalized', $gate->status($visit->id));

        $response = $this->postJson('/api/v1/final-results', [
            'visit_id' => $visit->id,
            'reason' => 'Salah input',
            'cancellation_date' => now()->toDateTimeString(),
            'requested_by' => 'Dr. Budi'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('final_result_cancellations', [
            'visit_id' => $visit->id,
            'status' => 'applied',
        ]);
        $this->assertSame('amending', $gate->status($visit->id));
    }

    /** RME yang belum final tidak punya final hasil untuk dibatalkan. */
    public function test_it_rejects_cancellation_when_record_is_not_finalized() {
        $visit = Visit::factory()->create();
        app(MedicalRecordGate::class)->start($visit->id, $this->user);

        $this->postJson('/api/v1/final-results', [
            'visit_id' => $visit->id,
            'reason' => 'Salah input',
            'cancellation_date' => now()->toDateTimeString(),
            'requested_by' => 'Dr. Budi'
        ])->assertStatus(422);

        $this->assertDatabaseCount('final_result_cancellations', 0);
    }

    /** RME yang belum pernah dibuka sama sekali juga ditolak. */
    public function test_it_rejects_cancellation_when_record_was_never_opened() {
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/final-results', [
            'visit_id' => $visit->id,
            'reason' => 'Salah input',
            'cancellation_date' => now()->toDateTimeString(),
            'requested_by' => 'Dr. Budi'
        ])->assertStatus(422);
    }

    /**
     * Catatan dan pembukaan RME berada dalam satu transaksi. Kalau pembukaan
     * gagal, catatannya tidak boleh tertinggal -- kalau tidak, riwayat akan
     * memuat pembatalan yang tak pernah terjadi.
     */
    public function test_status_cannot_be_forged_through_update() {
        $fr = FinalResult::factory()->create(['status' => 'applied']);

        $this->putJson("/api/v1/final-results/{$fr->id}", ['status' => 'reversed'])
            ->assertStatus(200);

        $this->assertSame('applied', $fr->fresh()->status);
    }
    public function test_can_update() {
        $fr = FinalResult::factory()->create(['reason' => 'Old']);
        $response = $this->putJson("/api/v1/final-results/{$fr->id}", ['reason' => 'New']);
        $response->assertStatus(200);
        $this->assertEquals('New', $fr->fresh()->reason);
    }
    public function test_can_delete() {
        // Pembatalan adalah catatan beralasan, bukan hard delete (peta induk
        // Temuan 16): destroy() membalik status jadi 'reversed', baris tetap ada.
        $fr = FinalResult::factory()->create();
        $response = $this->deleteJson("/api/v1/final-results/{$fr->id}");
        $response->assertStatus(200);
        $this->assertDatabaseHas('final_result_cancellations', ['id' => $fr->id, 'status' => 'reversed']);
    }
}
