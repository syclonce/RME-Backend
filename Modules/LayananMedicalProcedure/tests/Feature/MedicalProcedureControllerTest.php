<?php

namespace Modules\LayananMedicalProcedure\Tests\Feature;

use App\Modules\Contracts\HospitalConfig;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralService\Models\Service;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class MedicalProcedureControllerTest extends TestCase
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

    public function test_it_records_a_performed_procedure(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $service = Service::factory()->create();
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/medical-procedures', [
            'visit_id' => $visit->id,
            'service_id' => $service->id,
            'performed_by' => $performedBy->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'completed');
        $this->assertDatabaseHas('medical_procedures', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_procedures_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        MedicalProcedure::factory()->count(2)->create(['visit_id' => $visit->id]);
        MedicalProcedure::factory()->create();

        $response = $this->getJson("/api/v1/medical-procedures?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_cancels_a_procedure(): void
    {
        $this->actingUser();
        $procedure = MedicalProcedure::factory()->create();

        $response = $this->putJson("/api/v1/medical-procedures/{$procedure->id}", ['status' => 'cancelled']);

        $response->assertOk()->assertJsonPath('data.status', 'cancelled');
    }

    public function test_guest_cannot_access_medical_procedures(): void
    {
        $this->getJson('/api/v1/medical-procedures')->assertStatus(401);
    }

    /**
     * Port gerbang TindakanMedisResource.php:41-43 simgos2 (config 69 =
     * KUNCI_SEMUA_TRANSAKSI_SEBELUM_DI_FINAL_TAGIHAN): begitu kasir mengunci
     * tagihan kunjungan (Invoice::is_locked), tindakan medis baru ditolak.
     */
    public function test_procedure_rejected_when_visit_billing_is_locked(): void
    {
        $this->actingUser();
        app(HospitalConfig::class)->set('billing.lock_on_cashier_close', true, 'bool');

        $visit = Visit::factory()->create();
        Invoice::factory()->locked()->create(['visit_id' => $visit->id]);
        $service = Service::factory()->create();
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/medical-procedures', [
            'visit_id' => $visit->id,
            'service_id' => $service->id,
            'performed_by' => $performedBy->id,
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('medical_procedures', ['visit_id' => $visit->id]);
    }

    /**
     * Kunjungan dengan tagihan yang masih terbuka (belum dikunci kasir) tetap
     * menerima tindakan baru — gerbang tidak boleh menghalangi alur normal.
     */
    public function test_procedure_accepted_when_visit_billing_is_not_locked(): void
    {
        $this->actingUser();
        app(HospitalConfig::class)->set('billing.lock_on_cashier_close', true, 'bool');

        $visit = Visit::factory()->create();
        Invoice::factory()->create(['visit_id' => $visit->id, 'is_locked' => false]);
        $service = Service::factory()->create();
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/medical-procedures', [
            'visit_id' => $visit->id,
            'service_id' => $service->id,
            'performed_by' => $performedBy->id,
        ]);

        $response->assertCreated();
    }

    /**
     * Bila flag konfigurasi 'billing.lock_on_cashier_close' dimatikan RS,
     * gerbang tidak boleh menolak walau tagihan kunjungan terkunci — sama
     * seperti VisitService menghormati flag ini.
     */
    public function test_procedure_accepted_when_lock_gate_config_is_disabled(): void
    {
        $this->actingUser();
        app(HospitalConfig::class)->set('billing.lock_on_cashier_close', false, 'bool');

        $visit = Visit::factory()->create();
        Invoice::factory()->locked()->create(['visit_id' => $visit->id]);
        $service = Service::factory()->create();
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/medical-procedures', [
            'visit_id' => $visit->id,
            'service_id' => $service->id,
            'performed_by' => $performedBy->id,
        ]);

        $response->assertCreated();
    }

    /**
     * Port aturan TindakanMedisResource::create simgos2 (b.31-38): tindakan tidak
     * boleh dicatat bertanggal setelah pasien pulang, karena itu menambah tagihan
     * pada pasien yang sudah meninggalkan rumah sakit.
     */
    public function test_procedure_after_discharge_date_is_rejected(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create(['discharged_at' => now()->subDay()]);
        $service = Service::factory()->create();
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/medical-procedures', [
            'visit_id' => $visit->id,
            'service_id' => $service->id,
            'performed_by' => $performedBy->id,
            'performed_at' => now()->toDateTimeString(),
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('medical_procedures', ['visit_id' => $visit->id]);
    }

    /**
     * Kunjungan yang masih aktif (belum pulang) tetap menerima tindakan — memastikan
     * gerbang tanggal pulang tidak menghalangi alur normal.
     *
     * Catatan: kunjungan yang SUDAH pulang selalu ditolak lebih dulu oleh
     * MedicalRecordGate (VisitService::isActive menolak `discharged_at` terisi),
     * jadi gerbang tanggal di controller berperan sebagai lapis kedua — menangkap
     * kasus di mana episode RME masih berstatus `amending` sementara pasien sudah
     * pulang, yang melewati pemeriksaan keaktifan kunjungan.
     */
    public function test_active_visit_still_accepts_procedure(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create(['discharged_at' => null]);
        $service = Service::factory()->create();
        $performedBy = Employee::factory()->create();

        $this->postJson('/api/v1/medical-procedures', [
            'visit_id' => $visit->id,
            'service_id' => $service->id,
            'performed_by' => $performedBy->id,
            'performed_at' => now()->toDateTimeString(),
        ])->assertCreated();
    }

    /** Tindakan dicatat SETELAH dilakukan — status dari klien diabaikan. */
    public function test_status_cannot_be_injected_on_create(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/medical-procedures', [
            'visit_id' => $visit->id,
            'service_id' => Service::factory()->create()->id,
            'performed_by' => Employee::factory()->create()->id,
            'status' => 'cancelled',
        ])->assertCreated()->assertJsonPath('data.status', 'completed');
    }

    /**
     * Tindakan batal tidak dapat dihidupkan kembali — itu mengaburkan apa yang
     * benar-benar dikerjakan pada pasien. Legacy bahkan menolak DELETE sama
     * sekali (TindakanMedisResource::delete selalu 405).
     */
    public function test_cancelled_procedure_cannot_return_to_completed(): void
    {
        $this->actingUser();
        $procedure = MedicalProcedure::factory()->create(['status' => 'cancelled']);

        $this->putJson("/api/v1/medical-procedures/{$procedure->id}", ['status' => 'completed'])
            ->assertStatus(422);
    }

    public function test_completed_procedure_can_be_cancelled(): void
    {
        $this->actingUser();
        $procedure = MedicalProcedure::factory()->create(['status' => 'completed']);

        $this->putJson("/api/v1/medical-procedures/{$procedure->id}", ['status' => 'cancelled'])
            ->assertOk();

        $this->assertSame('cancelled', $procedure->fresh()->status);
    }
}
