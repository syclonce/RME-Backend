<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Perlebar `diagnosis_codes.name` dari 255 menjadi 500 karakter.
 *
 * Kamus ICD-10 Indonesian Modification memuat deskripsi hingga 277 karakter —
 * terutama pada bab XX (sebab luar cedera), mis. "Victim of cataclysmic storm,
 * School, Other Institution and Public Administration Area While engaged in
 * other specified activities". Memotong teksnya akan mengubah makna diagnosis,
 * jadi kolomnya yang diperlebar.
 *
 * 500 dipilih agar ada ruang untuk revisi ICD berikutnya tanpa migrasi lagi.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('diagnosis_codes', function (Blueprint $table) {
            $table->string('name', 500)->change();
        });
    }

    public function down(): void
    {
        Schema::table('diagnosis_codes', function (Blueprint $table) {
            $table->string('name', 255)->change();
        });
    }
};
