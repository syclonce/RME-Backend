<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tujuan pasien — ruangan/poli yang dituju, ditetapkan saat pendaftaran.
 *
 * Padanan legacy: `pendaftaran.tujuan_pasien`
 * (NOPEN, RUANGAN, RESERVASI, SMF, DOKTER, IKUT_IBU, KUNJUNGAN_IBU, STATUS).
 *
 * Sebelum tabel ini SIMGOS tidak menyimpan poli tujuan di mana pun: `visits.ward_id`
 * baru terisi setelah pasien DITERIMA petugas ruangan, sehingga tidak ada data untuk
 * antrean per-poli maupun Antrean Online BPJS. Terbukti di basis data pengembangan —
 * seluruh 5.027 baris `visits` ber-`ward_id` NULL.
 *
 * Pemisahan tujuan (rencana) dari kunjungan (realisasi) mengikuti legacy, dan memang
 * bentuk yang benar: pasien masuk antrean SEBELUM diterima di ruangan.
 *
 * Beda dari legacy, disengaja:
 * - relasi dijaga foreign key (legacy hanya 7 FK dari 361 tabel)
 * - `status` string bermakna, bukan tinyint tanpa kamus
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_destinations', function (Blueprint $table) {
            $table->id();

            // Kunci efektif legacy adalah NOPEN — satu pendaftaran satu tujuan.
            // `unique` menegakkan aturan yang di legacy hanya dijaga kode aplikasi.
            $table->foreignId('registration_id')->unique()->constrained('registrations')->cascadeOnDelete();

            $table->foreignId('ward_id')->constrained('wards');
            $table->foreignId('doctor_id')->nullable()->constrained('employees')->nullOnDelete();

            // IKUT_IBU / KUNJUNGAN_IBU legacy — bayi mengikuti rawat inap ibunya.
            $table->boolean('follows_mother')->default(false);
            $table->foreignId('mother_visit_id')->nullable()->constrained('visits')->nullOnDelete();

            // pending   = terdaftar, belum diterima ruangan  (legacy STATUS=1)
            // accepted  = sudah diterima, kunjungan dibuat   (legacy STATUS=2)
            // cancelled = tujuan dibatalkan                  (legacy STATUS=0)
            $table->string('status')->default('pending');

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['ward_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_destinations');
    }
};
