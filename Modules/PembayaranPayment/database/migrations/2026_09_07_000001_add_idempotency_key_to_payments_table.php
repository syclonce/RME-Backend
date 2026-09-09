<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Idempotency pembayaran (padanan modern "tunai upsert" legacy
     * PembayaranTagihanResource:57-62): double-click/tap ganda petugas atau
     * retry jaringan tidak boleh menciptakan dua baris pembayaran.
     * Klien (kasir UI) mengirim UUID per niat-bayar; server mengembalikan
     * baris yang sudah ada bila kuncinya pernah dipakai.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('idempotency_key', 64)->nullable()->unique()->after('payment_number');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropUnique(['idempotency_key']);
            $table->dropColumn('idempotency_key');
        });
    }
};
