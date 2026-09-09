<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Antrean ruangan dikunci ke PENDAFTARAN, bukan kunjungan.
 *
 * Legacy `pendaftaran.antrian_ruangan` memakai `REF = NOPEN` (nomor pendaftaran),
 * dan itu memang bentuk yang benar: pasien masuk antrean SAAT MENDAFTAR, sedangkan
 * kunjungan baru lahir ketika petugas ruangan MENERIMA-nya.
 *
 * Bentuk lama (`visit_id` wajib) membalik urutan itu — antrean baru bisa ada setelah
 * pasien diterima, sehingga tidak ada yang bisa mengantre. Itu juga memutus jalur
 * Antrean Online BPJS, yang di legacy dipicu trigger `onAfterInsertTujuanPasien`
 * begitu tujuan dibuat.
 *
 * `visit_id` dipertahankan sebagai nullable: terisi saat pasien diterima, sehingga
 * antrean tetap dapat ditelusuri ke kunjungan yang dihasilkannya.
 *
 * Aman dijalankan: tabel `ward_queues` kosong (0 baris) saat migrasi ini dibuat.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ward_queues', function (Blueprint $table) {
            $table->foreignId('registration_id')->nullable()->after('ward_id')
                ->constrained('registrations')->cascadeOnDelete();

            // Tanggal antrean: nomor antrean berulang tiap hari per ruangan,
            // sama seperti generator legacy yang berbasis (RUANGAN, TANGGAL).
            $table->date('queue_date')->nullable()->after('queue_number');

            $table->index(['ward_id', 'queue_date', 'status']);
        });

        Schema::table('ward_queues', function (Blueprint $table) {
            $table->unsignedBigInteger('visit_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('ward_queues', function (Blueprint $table) {
            $table->dropIndex(['ward_id', 'queue_date', 'status']);
            $table->dropConstrainedForeignId('registration_id');
            $table->dropColumn('queue_date');
        });
    }
};
