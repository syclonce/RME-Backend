<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Port BaseService:419-571 simgos2: penerbitan SEP WAJIB cek peserta dulu
     * untuk memperoleh kelas hak, dan `klsRawat` DIPAKSA = kelas hak peserta
     * (bukan input petugas). Tanpa kolom ini tidak ada tempat mencatat hasil
     * cek — dan tanpa gerbang, penerbitan bisa jalan tanpa cek.
     */
    public function up(): void
    {
        Schema::table('seps', function (Blueprint $table) {
            $table->string('participant_class')->nullable()->after('kelas_rawat');
            $table->dateTime('peserta_verified_at')->nullable()->after('participant_class');
        });
    }

    public function down(): void
    {
        Schema::table('seps', function (Blueprint $table) {
            $table->dropColumn(['participant_class', 'peserta_verified_at']);
        });
    }
};
