<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migrasi TAMBAHAN (bukan mengubah migrasi lama) untuk menyerap fitur
 * Modules/LayananImagingOrder ke radiology_orders — keputusan pemilik repo
 * 2026-09-04: LayananImagingOrder digabung ke LayananRadiologyOrder karena
 * RadiologyOrder punya dependen nyata (RadiologyOrderItem, RadiologyResult)
 * sedangkan ImagingOrder nol dependen. Kedua tabel 0 baris data saat migrasi
 * ini ditulis, jadi kolom baru aman ditambah tanpa backfill.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('radiology_orders', function (Blueprint $table) {
            // Diserap dari imaging_orders: label modality pemeriksaan pencitraan.
            // Nullable karena order radiologi non-imaging (mis. hanya foto polos
            // lama yang tak dikategorikan) tetap harus bisa dibuat tanpa nilai ini;
            // whitelist nilai (RadiologyOrder::MODALITIES) digerbang di FormRequest,
            // bukan di kolom, mengikuti pola modality di ImagingOrder lama.
            $table->string('modality')->nullable()->after('patient_id');
            $table->string('body_part')->nullable()->after('modality');
            // Diserap dari imaging_orders.scheduled_at: waktu penjadwalan
            // pengerjaan, diisi lewat gerbang eksplisit POST .../schedule.
            $table->dateTime('scheduled_at')->nullable()->after('ordered_at');
        });
    }

    public function down(): void
    {
        Schema::table('radiology_orders', function (Blueprint $table) {
            $table->dropColumn(['modality', 'body_part', 'scheduled_at']);
        });
    }
};
