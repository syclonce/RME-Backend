<?php

namespace Modules\LayananPrescription\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class PrescriptionControllerTest extends TestCase
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

    public function test_it_creates_prescription_with_auto_generated_number(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $doctor = Employee::factory()->create();

        $response = $this->postJson('/api/v1/prescriptions', [
            'visit_id' => $visit->id,
            'prescribed_by' => $doctor->id,
            'has_drug_allergy' => true,
        ]);

        $response->assertCreated()->assertJsonPath('data.has_drug_allergy', true);
        $this->assertStringStartsWith('RX-'.now()->format('Y').'-', $response->json('data.prescription_number'));
        $this->assertDatabaseHas('prescriptions', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_shows_prescription_with_items(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create();
        $prescription->items()->create([
            'drug_name' => 'Paracetamol 500mg',
            'dosage' => '1 tablet',
            'frequency' => '3x sehari',
        ]);

        $response = $this->getJson("/api/v1/prescriptions/{$prescription->id}");

        $response->assertOk()->assertJsonPath('data.items.0.drug_name', 'Paracetamol 500mg');
    }

    public function test_guest_cannot_access_prescriptions(): void
    {
        $this->getJson('/api/v1/prescriptions')->assertStatus(401);
    }

    /**
     * Port gerbang tagihan terkunci simgos2 (ReturFarmasiResource.php:33).
     * Setelah kasir mengunci tagihan, resep baru akan menambah biaya pada
     * tagihan yang sudah ditutup — karena itu ditolak.
     */
    public function test_prescription_rejected_when_billing_is_locked(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        Invoice::factory()->locked()->create(['visit_id' => $visit->id]);

        $this->postJson('/api/v1/prescriptions', [
            'visit_id' => $visit->id,
            'prescribed_by' => Employee::factory()->create()->id,
        ])->assertStatus(422);

        $this->assertDatabaseMissing('prescriptions', ['visit_id' => $visit->id]);
    }

    public function test_prescription_accepted_when_billing_is_not_locked(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        Invoice::factory()->create(['visit_id' => $visit->id, 'is_locked' => false]);

        $this->postJson('/api/v1/prescriptions', [
            'visit_id' => $visit->id,
            'prescribed_by' => Employee::factory()->create()->id,
        ])->assertCreated();
    }

    /**
     * Transisi minimal yang dijaga PrescriptionService: active -> cancelled.
     */
    public function test_active_prescription_can_be_cancelled(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create(['status' => 'active']);

        $response = $this->postJson("/api/v1/prescriptions/{$prescription->id}/cancel");

        $response->assertOk()->assertJsonPath('data.status', 'cancelled');
        $this->assertDatabaseHas('prescriptions', ['id' => $prescription->id, 'status' => 'cancelled']);
    }

    /**
     * Resep yang sudah dispensed tidak bisa dibatalkan lewat resep - obat
     * sudah keluar dan stok sudah terpotong (DispenseService). Pembatalan
     * untuk kasus ini harus lewat retur farmasi, bukan endpoint ini.
     */
    public function test_dispensed_prescription_cannot_be_cancelled(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create(['status' => 'dispensed']);

        $response = $this->postJson("/api/v1/prescriptions/{$prescription->id}/cancel");

        $response->assertStatus(422);
        $this->assertDatabaseHas('prescriptions', ['id' => $prescription->id, 'status' => 'dispensed']);
    }

    public function test_cancelled_prescription_cannot_be_cancelled_again(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create(['status' => 'cancelled']);

        $this->postJson("/api/v1/prescriptions/{$prescription->id}/cancel")->assertStatus(422);
    }
}
