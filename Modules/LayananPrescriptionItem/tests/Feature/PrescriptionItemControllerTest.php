<?php

namespace Modules\LayananPrescriptionItem\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryWardItemStock\Models\WardItemStock;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class PrescriptionItemControllerTest extends TestCase
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

    public function test_it_adds_drug_line_to_prescription(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create();

        $this->postJson('/api/v1/prescription-items', [
            'prescription_id' => $prescription->id,
            'drug_name' => 'Amoxicillin 500mg',
            'dosage' => '1 kapsul',
            'frequency' => '3x sehari',
        ])->assertCreated()->assertJsonPath('data.drug_name', 'Amoxicillin 500mg');
    }

    public function test_it_lists_items_filtered_by_prescription(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create();
        PrescriptionItem::factory()->count(2)->create(['prescription_id' => $prescription->id]);
        PrescriptionItem::factory()->create();

        $this->getJson("/api/v1/prescription-items?prescription_id={$prescription->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_rejects_item_when_quantity_exceeds_ward_stock(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $visit = Visit::factory()->create(['ward_id' => $ward->id]);
        $prescription = Prescription::factory()->create(['visit_id' => $visit->id]);
        $item = Item::factory()->create(['name' => 'Paracetamol 500mg']);
        WardItemStock::factory()->create([
            'item_id' => $item->id,
            'ward_id' => $ward->id,
            'quantity' => 5,
        ]);

        $this->postJson('/api/v1/prescription-items', [
            'prescription_id' => $prescription->id,
            'item_id' => $item->id,
            'drug_name' => 'Paracetamol 500mg',
            'dosage' => '1 tablet',
            'frequency' => '3x sehari',
            'quantity' => 10,
        ])->assertStatus(422)->assertJsonValidationErrors('quantity');
    }

    public function test_it_accepts_item_when_quantity_is_within_ward_stock(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $visit = Visit::factory()->create(['ward_id' => $ward->id]);
        $prescription = Prescription::factory()->create(['visit_id' => $visit->id]);
        $item = Item::factory()->create(['name' => 'Paracetamol 500mg']);
        WardItemStock::factory()->create([
            'item_id' => $item->id,
            'ward_id' => $ward->id,
            'quantity' => 20,
        ]);

        $this->postJson('/api/v1/prescription-items', [
            'prescription_id' => $prescription->id,
            'item_id' => $item->id,
            'drug_name' => 'Paracetamol 500mg',
            'dosage' => '1 tablet',
            'frequency' => '3x sehari',
            'quantity' => 10,
        ])->assertCreated()->assertJsonPath('data.quantity', 10);
    }

    /**
     * `ward_id` NULL adalah penanda RAWAT JALAN di SIMGOS (VisitController::index
     * memakai whereNull('ward_id')), bukan data yang belum lengkap. Resep rawat
     * jalan harus tetap bisa dibuat selama stok tersedia di salah satu depo —
     * pasien mengambil obat di apotek, bukan di bangsal.
     */
    public function test_it_accepts_outpatient_item_when_stock_exists_anywhere(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create(['ward_id' => null]);
        $prescription = Prescription::factory()->create(['visit_id' => $visit->id]);
        $item = Item::factory()->create(['name' => 'Paracetamol 500mg']);
        WardItemStock::factory()->create([
            'item_id' => $item->id,
            'ward_id' => Ward::factory()->create()->id,
            'quantity' => 10,
        ]);

        $this->postJson('/api/v1/prescription-items', [
            'prescription_id' => $prescription->id,
            'item_id' => $item->id,
            'drug_name' => 'Paracetamol 500mg',
            'dosage' => '1 tablet',
            'frequency' => '3x sehari',
            'quantity' => 3,
        ])->assertCreated();
    }

    /** Rawat jalan tetap ditolak bila stok memang habis di seluruh depo. */
    public function test_it_rejects_outpatient_item_when_no_stock_anywhere(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create(['ward_id' => null]);
        $prescription = Prescription::factory()->create(['visit_id' => $visit->id]);
        $item = Item::factory()->create(['name' => 'Paracetamol 500mg']);

        $this->postJson('/api/v1/prescription-items', [
            'prescription_id' => $prescription->id,
            'item_id' => $item->id,
            'drug_name' => 'Paracetamol 500mg',
            'dosage' => '1 tablet',
            'frequency' => '3x sehari',
            'quantity' => 1,
        ])->assertStatus(422)->assertJsonValidationErrors('quantity');
    }

    public function test_it_skips_stock_validation_for_unlinked_drug_name(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create();

        $this->postJson('/api/v1/prescription-items', [
            'prescription_id' => $prescription->id,
            'drug_name' => 'Racikan khusus',
            'dosage' => '1 sachet',
            'frequency' => '2x sehari',
            'quantity' => 1000,
        ])->assertCreated();
    }
}
