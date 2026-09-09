<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pola yang sama dengan outbox SATUSEHAT (Fase 4): worker butuh penghitung
     * percobaan untuk backoff + dead-letter. Tanpa ini satu baris rusak
     * di-POST selamanya setiap jalan scheduler.
     *
     * Nilai `kirim`: 1 = antre, 0 = terkirim, 2 = dead-letter (berhenti dicoba,
     * tetap di tabel untuk tindak lanjut petugas — kebalikan cacat legacy yang
     * menandai SELESAI saat gagal).
     */
    public function up(): void
    {
        Schema::table('pasien_tb', function (Blueprint $table) {
            $table->unsignedInteger('attempts')->default(0)->after('kirim');
        });
    }

    public function down(): void
    {
        Schema::table('pasien_tb', function (Blueprint $table) {
            $table->dropColumn('attempts');
        });
    }
};
