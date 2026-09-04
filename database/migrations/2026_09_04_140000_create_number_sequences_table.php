<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Padanan skema `generator` simgos2 (40+ tabel penghitung: no_pendaftaran,
 * no_kunjungan, no_tagihan, dst -- lihat db/new/generator/tables/).
 *
 * Legacy memberi tiap jenis nomor satu tabel AUTO_INCREMENT sendiri dan
 * mengambil nomor lewat INSERT + LAST_INSERT_ID() (routines/generateNoPendaftaran.sql),
 * BUKAN dengan menghitung baris yang sudah ada. Bedanya penting: `count()+1`
 * memberi nomor sama kepada dua permintaan yang datang bersamaan, dan mendaur
 * ulang nomor milik baris yang dihapus.
 *
 * Di sini 40+ tabel itu disatukan jadi satu tabel dengan kolom `scope` --
 * `scope` menampung kunci majemuk legacy (RUANGAN/TANGGAL/TAHUN) sebagai satu
 * string, sehingga tiap ruangan/tanggal tetap punya deret sendiri seperti aslinya.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('number_sequences', function (Blueprint $table) {
            $table->id();
            // Jenis nomor, mis. 'registration', 'invoice', 'final_result_cancellation'.
            $table->string('name', 64);
            // Cakupan deret: '2026', '2026-09-04', '2026-09-04:ward-7'. Padanan
            // kolom kunci majemuk pada tabel generator legacy.
            $table->string('scope', 64);
            $table->unsignedBigInteger('value')->default(0);
            $table->timestamps();

            $table->unique(['name', 'scope']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('number_sequences');
    }
};
