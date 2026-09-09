<?php

namespace Modules\LayananPharmacyDispense\Tests\Feature;

use App\Events\PrescriptionDispensed;
use App\Modules\Contracts\BillingGate;
use App\Modules\Contracts\HospitalConfig;
use App\Modules\Contracts\StockGate;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\GeneralWardVisitType\Models\WardVisitType;
use Modules\InventoryItem\Models\Item;
use Modules\LayananPharmacyDispense\Models\PharmacyDispense;
use Modules\LayananPrescriptionInitialReview\Database\Factories\PrescriptionInitialReviewFactory;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

/**
 * Alur farmasi end-to-end (#10): telaah → restriksi → eksekutif → stok →
 * tagihan, satu gerbang di DispenseService (port storeOrderResepDiFarmasi
 * + finalPelayananFarmasi simgos2).
 */
class DispenseFlowApiTest extends TestCase
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

    /**
     * Skenario dasar siap-layani: resep + item ber-obat, stok cukup,
     * telaah lulus bersih, tanpa penjamin direstriksi.
     */
    private function readyToDispense(int $stock = 100): Prescription
    {
        $visit = Visit::factory()->create(['ward_id' => Ward::factory()]);
        $prescription = Prescription::factory()->create(['visit_id' => $visit->id]);
        $item = Item::factory()->create(['sell_price' => '5000.00']);

        PrescriptionItem::factory()->create([
            'prescription_id' => $prescription->id,
            'item_id' => $item->id,
            'quantity' => 4,
        ]);

        app(StockGate::class)->adjust(
            (int) $visit->ward_id,
            $item->id,
            'in',
            $stock,
            User::factory()->create(),
        );

        PrescriptionInitialReviewFactory::new()->create([
            'prescription_id' => $prescription->id,
            'is_appropriate' => true,
            'issues_found' => null,
        ]);

        return $prescription;
    }

    public function test_tamu_ditolak_401(): void
    {
        $this->postJson('/api/v1/prescriptions/1/dispense')->assertUnauthorized();
    }

    public function test_happy_path_stok_turun_tagihan_terisi_status_dispensed(): void
    {
        Event::fake([PrescriptionDispensed::class]);
        $this->actingUser();

        $prescription = $this->readyToDispense(stock: 50);
        $wardId = (int) $prescription->visit->ward_id;
        $itemId = (int) $prescription->items->first()->item_id;

        $response = $this->postJson("/api/v1/prescriptions/{$prescription->id}/dispense");

        $response->assertCreated();

        // Stok ward turun 4.
        $this->assertSame(
            46,
            app(StockGate::class)->currentStock($wardId, $itemId),
        );

        // Tagihan kunjungan mendapat item medicine 4 × 5000 = 20000.
        $billing = app(BillingGate::class);
        $this->assertFalse($billing->isVisitLocked($prescription->visit_id));
        $tagihan = Invoice::query()
            ->where('visit_id', $prescription->visit_id)
            ->firstOrFail();
        $this->assertSame('20000.00', (string) $tagihan->total_amount);
        $this->assertSame('medicine', $tagihan->items()->first()->category);

        // Resep & dispense terfinalisasi.
        $this->assertSame('dispensed', $prescription->refresh()->status);
        $this->assertSame('dispensed', PharmacyDispense::query()->where('prescription_id', $prescription->id)->first()?->status);

        Event::assertDispatchedTimes(PrescriptionDispensed::class, 1);
    }

    public function test_tanpa_telaah_ditolak_422(): void
    {
        $this->actingUser();
        $prescription = Prescription::factory()->create();
        $item = Item::factory()->create();
        PrescriptionItem::factory()->create(['prescription_id' => $prescription->id, 'item_id' => $item->id]);

        $response = $this->postJson("/api/v1/prescriptions/{$prescription->id}/dispense");

        $response->assertStatus(422);
        $this->assertSame('active', $prescription->refresh()->status);
        $this->assertSame(0, PharmacyDispense::count());
    }

    public function test_telaah_bermasalah_ditolak_bila_screening_requires_all_checked(): void
    {
        // Port PropertiConfig 54: VALIDASI_TELAAH_AKHIR_HARUS_CENTANG_SEMUA (default TRUE).
        $this->actingUser();
        $prescription = Prescription::factory()->create();
        $item = Item::factory()->create();
        PrescriptionItem::factory()->create(['prescription_id' => $prescription->id, 'item_id' => $item->id]);

        PrescriptionInitialReviewFactory::new()->create([
            'prescription_id' => $prescription->id,
            'is_appropriate' => true,
            'issues_found' => 'Interaksi dengan obat rutin pasien.',
        ]);

        $this->postJson("/api/v1/prescriptions/{$prescription->id}/dispense")->assertStatus(422);
    }

    public function test_penjamin_restriksi_ditolak_422(): void
    {
        // Port PropertiConfig 125 hidup: daftar penjamin terlarang untuk resep.
        app(HospitalConfig::class)->set('restriction.restricted_payers_prescription', ['corporate'], 'json');

        $this->actingUser();
        $prescription = $this->readyToDispense();
        Guarantor::factory()->create([
            'registration_id' => $prescription->visit->registration_id,
            'payer_type' => 'corporate',
        ]);

        $this->postJson("/api/v1/prescriptions/{$prescription->id}/dispense")->assertStatus(422);
    }

    public function test_stok_kurang_ditolak_lalu_lolos_bila_allow_out_of_stock(): void
    {
        $this->actingUser();
        $prescription = $this->readyToDispense(stock: 2); // butuh 4.

        $this->postJson("/api/v1/prescriptions/{$prescription->id}/dispense")->assertStatus(422);

        // Port PropertiConfig 48: izinkan layanan meski stok kosong.
        app(HospitalConfig::class)->set('pharmacy.allow_order_out_of_stock', true, 'bool');

        $this->postJson("/api/v1/prescriptions/{$prescription->id}/dispense")->assertCreated();
    }

    public function test_resep_sudah_dispensed_tidak_bisa_dilayani_ulang(): void
    {
        $this->actingUser();
        $prescription = $this->readyToDispense();

        $this->postJson("/api/v1/prescriptions/{$prescription->id}/dispense")->assertCreated();
        $this->postJson("/api/v1/prescriptions/{$prescription->id}/dispense")->assertStatus(422);

        $this->assertSame(1, PharmacyDispense::count());
    }

    /**
     * Penyerahan obat melahirkan kunjungan di unit farmasi (padanan
     * `kunjungan.REF` prefix 14 legacy). Tanpa ini pendapatan farmasi tidak
     * terpisah dari poli pengirim.
     */
    public function test_dispense_creates_pharmacy_visit(): void
    {
        $this->actingUser();
        WardVisitType::query()->where('code', '11')->exists()
            ?: WardVisitType::create(['name' => 'Farmasi', 'code' => '11']);
        $pharmacyWard = Ward::factory()->create([
            'visit_type_id' => WardVisitType::query()->where('code', '11')->value('id'),
        ]);
        $prescription = $this->readyToDispense();

        $this->postJson("/api/v1/prescriptions/{$prescription->id}/dispense")->assertCreated();

        $this->assertSame(1, Visit::query()
            ->where('ward_id', $pharmacyWard->id)
            ->where('origin_type', PharmacyDispense::class)
            ->count());
    }
}
