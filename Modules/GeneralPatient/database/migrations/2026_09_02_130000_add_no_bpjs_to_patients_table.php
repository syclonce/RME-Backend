<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * No. BPJS adalah bagian dari Identitas pasien (setara NIK/paspor/IHS),
     * lihat docs-sim/CONTEXT.md baris 34 — BUKAN bagian dari Coverage/Penjamin
     * (itu konsep per-Pendaftaran/Kunjungan, level berbeda). Field dedicated
     * (bukan lewat identity_card_types generik) karena BPJS akan butuh
     * metadata tambahan nanti (status eligibilitas/kelas rawat) yang beda
     * struktur dari kartu identitas biasa. Tidak unique: pasien secara teori
     * bisa ganti kartu BPJS.
     */
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('no_bpjs', 20)->nullable()->after('nik');
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('no_bpjs');
        });
    }
};
