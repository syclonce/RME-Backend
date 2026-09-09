<?php

namespace Modules\PendaftaranVisit\Tests\Feature;

use App\Events\VisitDischarged;
use Database\Seeders\RoleAndPermissionSeeder;
use App\Modules\Contracts\HospitalConfig;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Modules\Auth\Models\User;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralRoom\Models\Room;
use Modules\GeneralWard\Models\Ward;
use Modules\GeneralWardTariff\Models\WardTariff;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceItem\Models\InvoiceItem;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisit\Models\VisitTransfer;
use Tests\TestCase;

/**
 * Gerbang pulang — port STATUS kunjungan → 2 pada trigger
 * onAfterUpdateKunjungan: bed dibebaskan, rekam pulang tercipta,
 * akomodasi rawat inap diposting ala pembayaran.storeAkomodasi.
 */
class VisitDischargeApiTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected Ward $ward;

    protected function setUp(): void
    {
        parent::setUp();


        $this->seed(RoleAndPermissionSeeder::class);
        $this->user = User::factory()->create();
        $this->user->assignRole('petugas');
        $this->actingAs($this->user, 'sanctum');
        $this->ward = Ward::factory()->create();
    }

    protected function admittedInBed(): Visit
    {
        $bed = Bed::factory()->create([
            'room_id' => Room::factory()->create(['ward_id' => $this->ward])->id,
        ]);

        $visit = Visit::factory()->create([
            'registration_id' => Registration::factory(),
            'ward_id' => $this->ward->id,
            'bed_id' => $bed->id,
            // 50 jam jauh dari batas pembulatan hari agar lama dirawat stabil = 3.
            'admitted_at' => now()->subHours(50),
        ]);
        $bed->update(['status' => Bed::STATUS_OCCUPIED]);

        return $visit;
    }

    public function test_tamu_ditolak_401(): void
    {
        $this->app['auth']->guard('sanctum')->forgetUser();
        $visit = Visit::factory()->create();

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", ['final_outcome' => 'sembuh'])
            ->assertUnauthorized();
    }

    public function test_pulang_mengosongkan_bed_dan_merekam_discharge(): void
    {
        Event::fake([VisitDischarged::class]);
        $visit = $this->admittedInBed();

        $response = $this->postJson("/api/v1/visits/{$visit->id}/discharge", [
            'final_outcome' => 'sembuh',
            'discharge_method' => 'pulang atas izin dokter',
            'follow_up_notes' => 'Kontrol poliklinik seminggu',
        ]);

        $response->assertOk()
            ->assertJsonPath('data.status', 'discharged')
            ->assertJsonPath('data.final_outcome', 'sembuh');

        // Bed bebas + kunjungan tertutup oleh aktor yang memulangkan.
        $this->assertSame(Bed::STATUS_AVAILABLE, $visit->bed->refresh()->status);
        $this->assertNotNull($visit->refresh()->discharged_at);
        $this->assertSame($this->user->id, (int) $visit->final_outcome_by);

        $this->assertDatabaseHas('patient_discharge_records', [
            'visit_id' => $visit->id,
            'discharge_method' => 'pulang atas izin dokter',
        ]);

        Event::assertDispatched(VisitDischarged::class);
    }

    public function test_pulang_memposting_akomodasi_bila_tarif_terpasang(): void
    {
        WardTariff::factory()->create([
            'ward_id' => $this->ward->id,
            'room_class_id' => null,
            'price' => '350000.00',
        ]);
        $visit = $this->admittedInBed();

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", [
            'final_outcome' => 'sembuh',
            'discharge_method' => 'pulang atas izin dokter',
        ])
            ->assertOk();

        $invoice = Invoice::query()->where('visit_id', $visit->id)->firstOrFail();
        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $invoice->id,
            'category' => 'accommodation',
            'quantity' => 3,
            'unit_price' => '350000.00',
        ]);
    }

    public function test_pulang_tanpa_tarif_tidak_memposting_akomodasi(): void
    {
        $visit = $this->admittedInBed();

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", [
            'final_outcome' => 'sembuh',
            'discharge_method' => 'rujuk',
        ])
            ->assertOk();

        $this->assertNull(Invoice::query()->where('visit_id', $visit->id)->first());
    }

    public function test_pulang_ulang_ditolak_422(): void
    {
        $visit = $this->admittedInBed();

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", [
            'final_outcome' => 'sembuh',
            'discharge_method' => 'pulang atas izin dokter',
        ])->assertOk();

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", [
            'final_outcome' => 'meninggal',
            'discharge_method' => 'meninggal',
        ])
            ->assertStatus(422);
    }

    public function test_pulang_memposting_akomodasi_tersegmentasi_per_mutasi_ward(): void
    {
        $wardA = $this->ward;
        $wardB = Ward::factory()->create();

        WardTariff::factory()->create(['ward_id' => $wardA->id, 'room_class_id' => null, 'price' => '200000.00', 'effective_date' => now()->subYears(2)]);
        WardTariff::factory()->create(['ward_id' => $wardB->id, 'room_class_id' => null, 'price' => '300000.00', 'effective_date' => now()->subYears(2)]);

        $visit = Visit::factory()->create([
            'registration_id' => Registration::factory(),
            'ward_id' => $wardB->id, // ward SAAT INI, setelah mutasi
            'bed_id' => null,
            // Jauh dari kelipatan 24 jam persis (ala admittedInBed()) supaya
            // pembulatan hari stabil walau ada drift milidetik antar timestamp.
            'admitted_at' => now()->subHours(76),
        ]);

        VisitTransfer::create([
            'visit_id' => $visit->id,
            'ward_from_id' => $wardA->id,
            'bed_from_id' => null,
            'ward_to_id' => $wardB->id,
            'bed_to_id' => null,
            'transferred_by' => $this->user->id,
            'transferred_at' => now()->subHours(26),
            'notes' => null,
        ]);

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", [
            'final_outcome' => 'sembuh',
            'discharge_method' => 'pulang atas izin dokter',
        ])->assertOk();

        $invoice = Invoice::query()->where('visit_id', $visit->id)->firstOrFail();

        // Segmen 1: wardA, 76h -> 26h = 50 jam = 3 malam @200rb.
        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $invoice->id,
            'category' => 'accommodation',
            'quantity' => 3,
            'unit_price' => '200000.00',
        ]);
        // Segmen 2: wardB, 26h -> pulang = 26 jam = 2 malam @300rb.
        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $invoice->id,
            'category' => 'accommodation',
            'quantity' => 2,
            'unit_price' => '300000.00',
        ]);
        $this->assertSame(2, InvoiceItem::query()->where('invoice_id', $invoice->id)->where('category', 'accommodation')->count());
    }

    public function test_akomodasi_pakai_tarif_yang_berlaku_pada_tanggal_segmen(): void
    {
        WardTariff::factory()->create(['ward_id' => $this->ward->id, 'room_class_id' => null, 'price' => '100000.00', 'effective_date' => now()->subYears(2)]);
        // Tarif baru belum berlaku (effective_date di masa depan) -- tidak boleh terpakai.
        WardTariff::factory()->create(['ward_id' => $this->ward->id, 'room_class_id' => null, 'price' => '500000.00', 'effective_date' => now()->addYear()]);

        $visit = $this->admittedInBed();

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", [
            'final_outcome' => 'sembuh',
            'discharge_method' => 'pulang atas izin dokter',
        ])->assertOk();

        $invoice = Invoice::query()->where('visit_id', $visit->id)->firstOrFail();
        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $invoice->id,
            'category' => 'accommodation',
            'unit_price' => '100000.00',
        ]);
        $this->assertDatabaseMissing('invoice_items', [
            'invoice_id' => $invoice->id,
            'unit_price' => '500000.00',
        ]);
    }

    public function test_final_outcome_wajib_diisi(): void
    {
        $visit = Visit::factory()->create();

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['final_outcome']);
    }

    /**
     * Aturan lama dirawat dapat dipilih per faskes — padanan `properti_config` 14
     * legacy (`ATURAN_PERHITUNGAN_AKOMODASI`) yang memilih di antara tiga varian
     * `getLamaDirawat`. Bedanya satu hari tarif kamar per pasien, jadi harus
     * benar-benar mengikuti kebijakan RS, bukan dipaku di kode.
     *
     * Kasus uji sengaja memakai menginap 20 jam yang melewati tengah malam:
     * `full_day` membacanya 1 hari, `calendar_day` membacanya 2 hari.
     */
    public function test_aturan_calendar_day_menghitung_pergantian_tanggal(): void
    {
        // HospitalConfig membaca tabel `rs_settings`, bukan config() Laravel —
        // menyetel lewat config() akan diabaikan diam-diam dan membuat tes ini
        // lolos tanpa benar-benar menguji apa pun.
        app(HospitalConfig::class)->set('billing.accommodation_day_rule', 'calendar_day');

        WardTariff::factory()->create([
            'ward_id' => $this->ward->id,
            'room_class_id' => null,
            'price' => '350000.00',
        ]);

        $bed = Bed::factory()->create([
            'room_id' => Room::factory()->create(['ward_id' => $this->ward])->id,
        ]);
        $visit = Visit::factory()->create([
            'registration_id' => Registration::factory(),
            'ward_id' => $this->ward->id,
            'bed_id' => $bed->id,
            // Masuk pukul 20:00 kemarin, pulang pukul 16:00 hari ini = 20 jam,
            // tetapi melewati satu pergantian tanggal.
            'admitted_at' => now()->subDay()->setTime(20, 0),
        ]);
        $bed->update(['status' => Bed::STATUS_OCCUPIED]);

        $this->travelTo(now()->setTime(16, 0));

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", [
            'final_outcome' => 'sembuh',
            'discharge_method' => 'pulang atas izin dokter',
        ])->assertOk();

        $invoice = Invoice::query()->where('visit_id', $visit->id)->firstOrFail();
        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $invoice->id,
            'category' => 'accommodation',
            'quantity' => 2,
        ]);
    }

    /**
     * KEPUTUSAN 2026-09-04: tagihan harus dapat dipecah per unit TANPA menerbitkan
     * kunjungan baru tiap mutasi. Penandanya ada di baris tagihan (`invoice_items.
     * ward_id`), bukan di kunjungan — jadi satu kunjungan rawat inap yang berpindah
     * bangsal tetap satu kunjungan, tetapi pendapatan tiap bangsal terpisah.
     */
    public function test_akomodasi_membawa_ward_pengerja_per_baris(): void
    {
        WardTariff::factory()->create([
            'ward_id' => $this->ward->id,
            'room_class_id' => null,
            'price' => '350000.00',
        ]);
        $visit = $this->admittedInBed();

        $this->postJson("/api/v1/visits/{$visit->id}/discharge", [
            'final_outcome' => 'sembuh',
            'discharge_method' => 'pulang atas izin dokter',
        ])->assertOk();

        $invoice = Invoice::query()->where('visit_id', $visit->id)->firstOrFail();

        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $invoice->id,
            'category' => 'accommodation',
            'ward_id' => $this->ward->id,
        ]);
    }
}
