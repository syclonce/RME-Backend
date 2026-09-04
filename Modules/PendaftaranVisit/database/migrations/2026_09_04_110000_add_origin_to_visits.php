<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Asal-usul kunjungan turunan — padanan `pendaftaran.kunjungan.REF` legacy.
 *
 * Di SIMGOS2 tiap pengiriman antar-unit MELAHIRKAN kunjungan baru di unit tujuan,
 * dan kunjungan itu menunjuk balik ke transaksi yang menerbitkannya lewat kolom
 * `REF` berprefiks dua digit (peta induk Temuan 4):
 *
 *   10 = konsul   11 = mutasi   12 = order lab   13 = order radiologi   14 = resep
 *
 * Prefix itu bukan hiasan — `KunjunganResource::create` (b.56-70) memakainya untuk
 * memilih privilege mana yang berlaku, dan `storeOrderResepDiFarmasi` memakai
 * `a.NOMOR = c.REF` untuk menemukan kunjungan farmasi milik sebuah order resep.
 *
 * Tanpa kolom ini, kunjungan di unit penunjang tidak dapat ditelusuri ke order yang
 * menerbitkannya: laboratorium tahu ia melayani pasien, tetapi tidak tahu atas
 * permintaan siapa dan untuk order yang mana.
 *
 * Bentuknya diperbaiki dari legacy: alih-alih satu string berprefiks yang harus
 * di-`substr`, dipakai pasangan polymorphic (`origin_type`, `origin_id`) yang
 * dijaga tipe dan dapat di-eager-load.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            // Kelas model penerbit: Consultation, LabOrder, RadiologyOrder,
            // Prescription, VisitTransfer. NULL = kunjungan dari pendaftaran
            // langsung (mayoritas rawat jalan).
            $table->string('origin_type')->nullable()->after('registration_id');
            $table->unsignedBigInteger('origin_id')->nullable()->after('origin_type');

            $table->index(['origin_type', 'origin_id']);
        });
    }

    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropIndex(['origin_type', 'origin_id']);
            $table->dropColumn(['origin_type', 'origin_id']);
        });
    }
};
