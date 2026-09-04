<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Dua kolom sisa dari `pembayaran.penjamin_tagihan` legacy yang belum
 * ditampung migrasi `2026_09_04_130000_add_class_upgrade_to_invoice_guarantors`:
 *
 * - `days_upgraded` — port `LAMA_NAIK` (SP `prosesPerhitunganBPJS` b.137-162):
 *   jumlah hari pasien dirawat pada kelas yang lebih tinggi dari haknya.
 *   Dipakai laporan/klaim, bukan bagian hitungan subsidi itu sendiri.
 *
 * - `entitled_class_total` — port `TOTAL_TAGIHAN_HAK` (b.212-228, dipakai
 *   b.267-269 untuk subsidi "naik di atas VIP"). Legacy mengisinya sebagai
 *   AKUMULATOR bertahap: tiap baris rincian tagihan baru menambah/mengurangi
 *   kolom ini (`UPDATE ... SET TOTAL_TAGIHAN_HAK = TOTAL_TAGIHAN_HAK +- PTOTAL`)
 *   setiap kali `storeRincianTagihan` memanggil SP ini per baris. SIMGOS TIDAK
 *   punya proses posting per-baris yang setara (InvoiceService menghitung ulang
 *   total dari nol lewat recalculateTotals(), bukan akumulasi bertahap) — lihat
 *   docblock ClassUpgradeCalculationService untuk detail gap ini. Kolom ini
 *   tetap disediakan sebagai TEMPAT PENYIMPANAN hasil akhir (dipasok pemanggil
 *   sebagai parameter, bukan diakumulasi di sini), supaya nilainya persisten
 *   dan tersedia untuk klaim/laporan seperti legacy.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoice_guarantors', function (Blueprint $table) {
            $table->unsignedSmallInteger('days_upgraded')->default(0)->after('hospital_subsidy');
            $table->decimal('entitled_class_total', 15, 2)->default(0)->after('days_upgraded');
        });
    }

    public function down(): void
    {
        Schema::table('invoice_guarantors', function (Blueprint $table) {
            $table->dropColumn(['days_upgraded', 'entitled_class_total']);
        });
    }
};
