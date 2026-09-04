<?php

namespace Modules\PembayaranInvoiceGuarantor\Services;

use App\Modules\Contracts\HospitalConfig;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;

/**
 * Perhitungan naik kelas dan selisih biaya BPJS.
 *
 * Port penuh `pembayaran.prosesPerhitunganBPJS` (362 baris, opsi A — keputusan
 * pemilik repo 2026-09-04). Ketepatan didahulukan: salah hitung di sini berarti
 * salah uang, ditanggung pasien atau rumah sakit.
 *
 * ## Tiga flag konfigurasi legacy (sudah diseed RsSettingSeeder)
 *
 * | Legacy (PropertiConfig) | HospitalConfig key | Default legacy | Efek |
 * |---|---|---|---|
 * | ID 9 `ATURAN_JKN_MENGIKUTI_KEBIJAKAN_RS` | `jkn.follow_hospital_policy` | FALSE | aturan JKN diganti kebijakan RS -> subsidi dipaksa 0 (b.166-208, 321-323) |
 * | ID 16 `MINIMAL_SELISIH_DARI_TARIF_INACBG_DALAM_PERSEN` | `inacbg.min_tariff_difference_percent` | 0 | batas bawah selisih naik kelas VIP (b.281, 285-294) |
 * | ID 20 `AKTIFKAN_MANUAL_PERSENTASE_INACBG_NAIK_VIP` | `inacbg.manual_vip_upclass_percentage` | TRUE | bila TRUE: selisih minimal TIDAK dihitung otomatis, subsidi dipaksa 0 (b.284, 303-308). Default legacy-nya TRUE, jadi klaster VIP baru menghasilkan selisih minimal otomatis hanya setelah faskes menonaktifkan flag ini. |
 *
 * ## Yang TIDAK diport (dilaporkan, bukan dikarang)
 *
 * - **Pasien titipan** (`kunjungan.TITIPAN`/`TITIPAN_KELAS`, b.144-156): SIMGOS
 *   tidak punya konsep pasien dititipkan di kelas lain dari haknya (dikonfirmasi
 *   tidak ada model/kolom/enum apa pun untuk ini). Bila LAMA_NAIK legacy
 *   mengecualikan/menyesuaikan hari titipan, `$daysUpgraded` di sini tidak bisa
 *   mereplikasi itu -- ia murni menerima nilai yang sudah dihitung pemanggil.
 *
 * - **Normalisasi kelas lewat `master.group_referensi_kelas`** (b.71-100):
 *   SIMGOS tidak punya tabel padanan. Datanya sendiri di legacy adalah pemetaan
 *   identitas (REFERENSI_KELAS == KELAS untuk semua baris seed), jadi yang
 *   benar-benar dibutuhkan hanyalah SKALA numeriknya: 0=non-kelas, 1=Kelas 3,
 *   2=Kelas 2, 3=Kelas 1, 4=VIP, 5+=di atas VIP. Parameter `$entitledClass`/
 *   `$treatedClass` pada method `calculate()` HARUS sudah dalam skala ini --
 *   resolusi dari `room_classes` SIMGOS (yang tidak native berskala begini,
 *   lihat kolom `code` Kemkes 0001-0008) adalah tanggung jawab pemanggil.
 *
 * - **`TOTAL_TAGIHAN_HAK` sebagai akumulator bertahap** (b.212-228): legacy
 *   mengisi kolom ini dengan menambah/mengurangi PTOTAL setiap kali SATU BARIS
 *   rincian tagihan diposting (dipanggil dari `storeRincianTagihan`, per baris,
 *   termasuk PINSERTED=false untuk update-in-place yang mengurangi nilai lama
 *   dulu). SIMGOS tidak memposting baris tagihan satu-satu ke prosedur ini --
 *   InvoiceService menghitung ulang invoice dari nol (`recalculateTotals()`).
 *   Method ini TIDAK mereplikasi akumulasi bertahap tsb; `$entitledClassTotal`
 *   diterima sebagai parameter yang sudah dihitung pemanggil (mis. SUM baris
 *   invoice_items yang preinci menurut kelas hak), lalu sekadar disimpan.
 *   Bila pemanggil belum bisa menghitungnya (butuh resolusi kelas ruang per
 *   baris tagihan, di luar cakupan tugas ini), kirim 0 -- efeknya subsidi
 *   "naik di atas VIP" akan under-computed, BUKAN salah arah (lihat b.267-269).
 */
class ClassUpgradeCalculationService
{
    /** Batas atas selisih naik kelas VIP menurut aturan JKN: 75% tarif INA-CBG kelas 1 (b.282). */
    private const VIP_MAX_PERCENT = 75.0;

    /** Skala kelas legacy di mana >4 berarti di atas VIP (b.106, master.group_referensi_kelas KELAS=5=VVIP dst). */
    private const ABOVE_VIP_THRESHOLD = 4;

    /** Skala kelas legacy untuk VIP (b.106-120). */
    private const VIP_CLASS = 4;

    public function __construct(protected HospitalConfig $config) {}

    /**
     * Hitung dan simpan naik kelas untuk satu lampiran penjamin (penjamin BPJS).
     *
     * PENTING soal skala kelas: parameter di sini memakai skala
     * `master.group_referensi_kelas` legacy (0=non-kelas, 1=Kelas 3, 2=Kelas 2,
     * 3=Kelas 1, 4=VIP, 5+=di atas VIP) -- BUKAN urutan mentah "Kelas 1 lebih
     * tinggi dari Kelas 2". Pemanggil bertanggung jawab menormalisasi kelas
     * ruang SIMGOS ke skala ini sebelum memanggil method ini (lihat catatan
     * "Normalisasi kelas" di docblock kelas).
     *
     * @param  int  $entitledClass  kelas hak peserta, skala legacy (1-3; 0 = tidak berkelas)
     * @param  int  $treatedClass   kelas rawat yang ditempati, skala legacy (1-3, 4=VIP, >4=di atas VIP)
     * @param  float  $totalBill  total tagihan riil kunjungan (VTOTAL_TAGIHAN, b.46)
     * @param  float  $class1Tariff  tarif INA-CBG kelas 1 dari hasil grouping (TARIFKLS1 b.51)
     * @param  float  $class2Tariff  tarif INA-CBG kelas 2 dari hasil grouping (TARIFKLS2 b.50)
     * @param  int  $daysUpgraded  lama hari dirawat di kelas naik (LAMA_NAIK, b.137-162) -- dihitung pemanggil, lihat catatan TITIPAN
     * @param  float  $entitledClassTotal  total tagihan bila diberi tarif kelas hak (TOTAL_TAGIHAN_HAK, b.212-228) -- dihitung pemanggil, lihat catatan akumulator
     */
    public function calculate(
        InvoiceGuarantor $attachment,
        int $entitledClass,
        int $treatedClass,
        float $totalBill,
        float $class1Tariff,
        float $class2Tariff,
        int $daysUpgraded = 0,
        float $entitledClassTotal = 0.0,
    ): InvoiceGuarantor {
        $isVipUpgrade = false;
        $isAboveVip = false;
        $isClassUpgrade = false;
        $upgradeTotal = 0.0;

        // Deteksi naik kelas -- tiga cabang, port legacy b.103-133.
        if ($treatedClass > self::ABOVE_VIP_THRESHOLD) {
            // Di atas VIP: tarif acuan selalu kelas 1, berapa pun kelas hak (b.106-112).
            $isAboveVip = true;
            $upgradeTotal = $class1Tariff;
        } elseif ($treatedClass === self::VIP_CLASS) {
            // Naik ke VIP (b.113-120).
            $isVipUpgrade = true;
            $upgradeTotal = $class1Tariff;
        } elseif ($treatedClass > $entitledClass) {
            // Naik kelas biasa, dalam rentang 1-3 (b.121-132). Acuan tarif
            // mengikuti kelas yang ditempati: kelas 2 -> tarif kelas 2,
            // selain itu (kelas 1) -> tarif kelas 1.
            $isClassUpgrade = true;
            $upgradeTotal = $treatedClass === 2 ? $class2Tariff : $class1Tariff;
        }

        $guaranteedTotal = (float) $attachment->covered_amount;

        // Selisih di-floor ke 0: tagihan di bawah jaminan tidak menghasilkan
        // kelebihan yang bisa ditagihkan (legacy b.259-260).
        $difference = max(0.0, $totalBill - $guaranteedTotal);

        $subsidy = 0.0;
        $minimumDifference = 0.0;

        // Kebijakan RS menggantikan aturan JKN -> subsidi dipaksa 0 (legacy
        // b.166-208 mengubah TOTAL/TOTAL_NAIK_KELAS lebih dulu, lalu b.321-323
        // menghapus subsidi terlepas dari cabang mana pun). Dicek lebih dulu
        // karena ia membatalkan seluruh perhitungan subsidi di bawah.
        $hospitalPolicy = $this->flag('jkn.follow_hospital_policy');

        if (! $hospitalPolicy && $difference > 0) {
            if (! $isClassUpgrade && ! $isVipUpgrade && ! $isAboveVip) {
                // Tidak naik kelas: seluruh selisih ditanggung RS. Pasien yang
                // dirawat sesuai haknya tidak boleh diminta membayar kekurangan
                // tarif INA-CBG (legacy b.263-264).
                $subsidy = $difference;
            } elseif ($isAboveVip) {
                // Di atas VIP: yang disubsidi hanya bagian sampai TOTAL_TAGIHAN_HAK
                // (bukan VTOTAL_TAGIHAN mentah -- legacy b.266-269 memakai
                // VTOTAL_TAGIHAN_HAK, tarif bila dirawat sesuai haknya, bukan
                // total tagihan riil). Lihat catatan akumulator di docblock kelas
                // soal keterbatasan $entitledClassTotal di SIMGOS.
                $subsidy = max(0.0, $entitledClassTotal - $guaranteedTotal);
            }
            // Naik kelas biasa -> subsidi tetap 0 di sini (legacy b.265-271 tidak
            // mengisi VSUBSIDI untuk cabang ini); dipertegas lagi di bawah
            // (b.311-316) untuk jaga-jaga bila subsidi lama masih tersimpan.
        }

        if ($isVipUpgrade) {
            $minimumDifference = $this->vipMinimumDifference($totalBill, $upgradeTotal);

            // Flag 20 aktif (default legacy TRUE): selisih minimal otomatis
            // dimatikan, subsidi dipaksa 0 -- faskes mengatur persentase
            // secara manual di luar hitungan ini (legacy b.284, 303-308).
            if ($this->flag('inacbg.manual_vip_upclass_percentage', true)) {
                $minimumDifference = 0.0;
                $subsidy = 0.0;
            }
        } elseif ($isClassUpgrade) {
            // Naik kelas biasa -> subsidi selalu 0 (legacy b.310-316).
            $subsidy = 0.0;
        }

        if ($hospitalPolicy) {
            $subsidy = 0.0;
        }

        $attachment->update([
            'is_class_upgrade' => $isClassUpgrade,
            'is_vip_upgrade' => $isVipUpgrade,
            'is_above_vip_upgrade' => $isAboveVip,
            'inacbg_class1_tariff' => $class1Tariff,
            'class_upgrade_total' => $upgradeTotal,
            'minimum_difference' => round($minimumDifference, 2),
            'hospital_subsidy' => round($subsidy, 2),
            'days_upgraded' => ($isClassUpgrade || $isVipUpgrade || $isAboveVip) ? $daysUpgraded : 0,
            'entitled_class_total' => $entitledClassTotal,
        ]);

        return $attachment->refresh();
    }

    /**
     * Selisih minimal naik kelas VIP, dijepit antara batas bawah (persen
     * konfigurasi) dan batas atas 75% tarif INA-CBG kelas 1 (legacy b.274-298).
     *
     * Bila persen konfigurasi = 75, hasilnya langsung batas atas -- legacy
     * memperlakukannya sebagai kasus khusus (b.295-297) supaya perbandingan
     * `VSEL > VSELMAX` tidak pernah salah membandingkan titik yang sama persis.
     */
    protected function vipMinimumDifference(float $totalBill, float $upgradeTotal): float
    {
        $percent = (float) $this->config->get('inacbg.min_tariff_difference_percent', 0);

        $actual = $totalBill - $upgradeTotal;
        $min = $upgradeTotal * ($percent / 100);
        $max = $upgradeTotal * (self::VIP_MAX_PERCENT / 100);

        if ($percent === self::VIP_MAX_PERCENT) {
            return $max;
        }

        if ($actual <= $min) {
            return $min;
        }

        return $actual > $max ? $max : $actual;
    }

    /**
     * Baca flag bool dari HospitalConfig, toleran terhadap nilai lama yang
     * masih tersimpan sebagai string 'TRUE'/'FALSE' (mis. lewat set() tanpa
     * type eksplisit di test/seeder lama).
     */
    protected function flag(string $key, bool $default = false): bool
    {
        $value = $this->config->get($key, $default);

        return $value === true || $value === 'TRUE' || $value === '1' || $value === 1;
    }
}
