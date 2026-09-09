<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kolom hasil perhitungan naik kelas BPJS.
 *
 * Padanan kolom `pembayaran.penjamin_tagihan` legacy yang diisi
 * `prosesPerhitunganBPJS` (362 baris): NAIK_KELAS, NAIK_KELAS_VIP,
 * NAIK_DIATAS_VIP, TOTAL_NAIK_KELAS, TARIF_INACBG_KELAS1, SELISIH_MINIMAL.
 *
 * Disimpan sebagai kolom, bukan dihitung saat dibaca, karena angkanya harus
 * TETAP setelah tagihan final — tarif INA-CBG dan kebijakan RS dapat berubah,
 * sementara tagihan yang sudah ditutup tidak boleh ikut berubah nilainya.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoice_guarantors', function (Blueprint $table) {
            // Tiga penanda terpisah, mengikuti legacy: naik kelas biasa (dalam
            // kelas 1-3), naik ke VIP (kelas 4), dan naik di atas VIP (>4).
            // Aturan subsidinya berbeda untuk ketiganya, jadi tidak bisa
            // disatukan menjadi satu kolom tingkat.
            $table->boolean('is_class_upgrade')->default(false)->after('coverage_percentage');
            $table->boolean('is_vip_upgrade')->default(false)->after('is_class_upgrade');
            $table->boolean('is_above_vip_upgrade')->default(false)->after('is_vip_upgrade');

            $table->decimal('inacbg_class1_tariff', 15, 2)->default(0)->after('is_above_vip_upgrade');
            $table->decimal('class_upgrade_total', 15, 2)->default(0)->after('inacbg_class1_tariff');
            $table->decimal('minimum_difference', 15, 2)->default(0)->after('class_upgrade_total');
            $table->decimal('hospital_subsidy', 15, 2)->default(0)->after('minimum_difference');
        });
    }

    public function down(): void
    {
        Schema::table('invoice_guarantors', function (Blueprint $table) {
            $table->dropColumn([
                'is_class_upgrade', 'is_vip_upgrade', 'is_above_vip_upgrade',
                'inacbg_class1_tariff', 'class_upgrade_total',
                'minimum_difference', 'hospital_subsidy',
            ]);
        });
    }
};
