<?php

namespace Modules\PembayaranInvoiceGuarantor\Tests\Feature;

use App\Modules\Contracts\HospitalConfig;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;
use Modules\PembayaranInvoiceGuarantor\Services\ClassUpgradeCalculationService;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Tests\TestCase;

/**
 * Port `prosesPerhitunganBPJS` legacy (362 baris). Tiap cabang diuji terpisah
 * karena salah hitung di sini berarti salah uang -- ditanggung pasien atau
 * rumah sakit.
 *
 * Kunci HospitalConfig yang dipakai di sini SUDAH diseed RsSettingSeeder
 * (lihat pemetaan lengkap di docblock ClassUpgradeCalculationService):
 *   - jkn.follow_hospital_policy               (PropertiConfig 9,  default FALSE)
 *   - inacbg.min_tariff_difference_percent     (PropertiConfig 16, default 0)
 *   - inacbg.manual_vip_upclass_percentage     (PropertiConfig 20, default TRUE)
 *
 * PENTING: default legacy config 20 adalah TRUE, yang berarti klaim minimal
 * VIP OTOMATIS *dimatikan* secara default (b.284, 303-308) -- test yang ingin
 * melihat klem 75%/batas-bawah beraksi harus menonaktifkan flag ini secara
 * eksplisit, sebagaimana faskes sungguhan harus melakukannya untuk mengaktifkan
 * hitungan otomatis.
 */
class ClassUpgradeCalculationTest extends TestCase
{
    use RefreshDatabase;

    private function attachment(float $covered): InvoiceGuarantor
    {
        return InvoiceGuarantor::create([
            'invoice_id' => Invoice::factory()->create()->id,
            'guarantor_id' => Guarantor::factory()->create(['payer_type' => 'bpjs'])->id,
            'covered_amount' => $covered,
            'sequence' => 1,
        ]);
    }

    private function service(): ClassUpgradeCalculationService
    {
        return app(ClassUpgradeCalculationService::class);
    }

    /** Dirawat sesuai hak: seluruh selisih ditanggung RS (legacy b.263-264). */
    public function test_no_upgrade_makes_hospital_absorb_the_difference(): void
    {
        $attachment = $this->attachment(covered: 5_000_000);

        $result = $this->service()->calculate(
            $attachment, entitledClass: 3, treatedClass: 3,
            totalBill: 6_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
        );

        $this->assertFalse((bool) $result->is_class_upgrade);
        $this->assertEqualsWithDelta(1_000_000, (float) $result->hospital_subsidy, 0.01);
    }

    /** Naik kelas biasa (dalam 1-3): tanggungan pasien, subsidi RS 0 (legacy b.121-132, 310-316). */
    public function test_regular_upgrade_gives_no_hospital_subsidy(): void
    {
        $attachment = $this->attachment(covered: 5_000_000);

        // Skala legacy: 1=Kelas 3 (hak), 2=Kelas 2 (ditempati) -> naik satu tingkat.
        $result = $this->service()->calculate(
            $attachment, entitledClass: 1, treatedClass: 2,
            totalBill: 7_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
        );

        $this->assertTrue((bool) $result->is_class_upgrade);
        $this->assertEqualsWithDelta(0, (float) $result->hospital_subsidy, 0.01);
        // Kelas 2 memakai tarif kelas 2 sebagai acuan (legacy b.125-126).
        $this->assertEqualsWithDelta(6_500_000, (float) $result->class_upgrade_total, 0.01);
    }

    /** Naik kelas biasa ke kelas 1: acuan tarif kelas 1 (legacy b.125, cabang default). */
    public function test_regular_upgrade_to_class1_uses_class1_tariff(): void
    {
        $attachment = $this->attachment(covered: 5_000_000);

        // Skala legacy: 1=Kelas 3 (hak), 3=Kelas 1 (ditempati) -> naik dua tingkat.
        $result = $this->service()->calculate(
            $attachment, entitledClass: 1, treatedClass: 3,
            totalBill: 9_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
        );

        $this->assertTrue((bool) $result->is_class_upgrade);
        $this->assertEqualsWithDelta(8_000_000, (float) $result->class_upgrade_total, 0.01);
    }

    /**
     * Default legacy: config 20 TRUE -> selisih minimal VIP OTOMATIS dimatikan,
     * subsidi dipaksa 0, walau tetap terdeteksi sebagai naik VIP (b.284, 303-308).
     */
    public function test_vip_upgrade_defaults_to_manual_percent_with_zero_subsidy(): void
    {
        $attachment = $this->attachment(covered: 5_000_000);

        $result = $this->service()->calculate(
            $attachment, entitledClass: 3, treatedClass: 4,
            totalBill: 100_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
        );

        $this->assertTrue((bool) $result->is_vip_upgrade);
        $this->assertEqualsWithDelta(0, (float) $result->minimum_difference, 0.01);
        $this->assertEqualsWithDelta(0, (float) $result->hospital_subsidy, 0.01);
    }

    /** Naik VIP, klem otomatis diaktifkan: selisih riil di atas 75% dijepit ke batas atas (b.281-298). */
    public function test_vip_upgrade_difference_is_capped_at_75_percent(): void
    {
        app(HospitalConfig::class)->set('inacbg.manual_vip_upclass_percentage', false, 'bool');
        app(HospitalConfig::class)->set('inacbg.min_tariff_difference_percent', 0, 'int');
        $attachment = $this->attachment(covered: 5_000_000);

        // Selisih riil 92 juta jauh melewati batas 75% x 8 juta = 6 juta.
        $result = $this->service()->calculate(
            $attachment, entitledClass: 3, treatedClass: 4,
            totalBill: 100_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
        );

        $this->assertTrue((bool) $result->is_vip_upgrade);
        $this->assertEqualsWithDelta(6_000_000, (float) $result->minimum_difference, 0.01);
    }

    /** Naik VIP, klem otomatis diaktifkan: selisih riil di bawah batas bawah dinaikkan ke batas bawah (b.285-294). */
    public function test_vip_upgrade_difference_is_floored_at_configured_percent(): void
    {
        app(HospitalConfig::class)->set('inacbg.manual_vip_upclass_percentage', false, 'bool');
        app(HospitalConfig::class)->set('inacbg.min_tariff_difference_percent', 20, 'int');
        $attachment = $this->attachment(covered: 5_000_000);

        // Selisih riil 1 juta < batas bawah 20% x 8 juta = 1,6 juta.
        $result = $this->service()->calculate(
            $attachment, entitledClass: 3, treatedClass: 4,
            totalBill: 9_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
        );

        $this->assertEqualsWithDelta(1_600_000, (float) $result->minimum_difference, 0.01);
    }

    /** Persen konfigurasi = 75 -> kasus khusus, langsung batas atas (b.295-297). */
    public function test_vip_upgrade_at_exactly_75_percent_config_uses_max_directly(): void
    {
        app(HospitalConfig::class)->set('inacbg.manual_vip_upclass_percentage', false, 'bool');
        app(HospitalConfig::class)->set('inacbg.min_tariff_difference_percent', 75, 'int');
        $attachment = $this->attachment(covered: 5_000_000);

        $result = $this->service()->calculate(
            $attachment, entitledClass: 3, treatedClass: 4,
            totalBill: 8_500_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
        );

        $this->assertEqualsWithDelta(6_000_000, (float) $result->minimum_difference, 0.01);
    }

    /** Flag 9 aktif: kebijakan RS menggantikan aturan JKN, subsidi 0 (legacy b.166-208, 321-323). */
    public function test_hospital_policy_flag_forces_zero_subsidy(): void
    {
        app(HospitalConfig::class)->set('jkn.follow_hospital_policy', true, 'bool');
        $attachment = $this->attachment(covered: 5_000_000);

        $result = $this->service()->calculate(
            $attachment, entitledClass: 3, treatedClass: 3,
            totalBill: 6_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
        );

        $this->assertEqualsWithDelta(0, (float) $result->hospital_subsidy, 0.01);
    }

    /**
     * Di atas VIP: acuan tarif selalu kelas 1 (b.106-112), dan subsidi memakai
     * TOTAL_TAGIHAN_HAK (tarif bila dirawat sesuai hak) -- BUKAN total tagihan
     * riil (b.266-269). Di sini entitledClassTotal dikirim eksplisit oleh
     * pemanggil (lihat catatan akumulator TOTAL_TAGIHAN_HAK di docblock service).
     */
    public function test_above_vip_uses_class1_tariff_and_entitled_total_for_subsidy(): void
    {
        $attachment = $this->attachment(covered: 5_000_000);

        $result = $this->service()->calculate(
            $attachment, entitledClass: 1, treatedClass: 5,
            totalBill: 50_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
            entitledClassTotal: 7_500_000,
        );

        $this->assertTrue((bool) $result->is_above_vip_upgrade);
        $this->assertEqualsWithDelta(8_000_000, (float) $result->class_upgrade_total, 0.01);
        // Subsidi = TOTAL_TAGIHAN_HAK - TOTAL_JAMINAN = 7.5jt - 5jt, BUKAN 50jt - 5jt.
        $this->assertEqualsWithDelta(2_500_000, (float) $result->hospital_subsidy, 0.01);
    }

    /** Tagihan di bawah jaminan tidak menghasilkan selisih (legacy b.259-260). */
    public function test_bill_below_coverage_produces_no_difference(): void
    {
        $attachment = $this->attachment(covered: 10_000_000);

        $result = $this->service()->calculate(
            $attachment, entitledClass: 3, treatedClass: 3,
            totalBill: 6_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
        );

        $this->assertEqualsWithDelta(0, (float) $result->hospital_subsidy, 0.01);
    }

    /** LAMA_NAIK disimpan hanya ketika benar-benar naik kelas (legacy b.135-163: dibungkus IF VNAIK_KELAS). */
    public function test_days_upgraded_is_stored_only_when_upgraded(): void
    {
        $attachment = $this->attachment(covered: 5_000_000);

        $noUpgrade = $this->service()->calculate(
            $attachment, entitledClass: 3, treatedClass: 3,
            totalBill: 5_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
            daysUpgraded: 4,
        );
        $this->assertSame(0, $noUpgrade->days_upgraded);

        $upgraded = $this->service()->calculate(
            $attachment, entitledClass: 1, treatedClass: 2,
            totalBill: 5_000_000, class1Tariff: 8_000_000, class2Tariff: 6_500_000,
            daysUpgraded: 4,
        );
        $this->assertSame(4, $upgraded->days_upgraded);
    }
}
