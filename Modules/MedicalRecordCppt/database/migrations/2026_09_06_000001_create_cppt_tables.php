<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * CPPT (Catatan Perkembangan Pasien Terintegrasi) + verifikasinya.
     * Port legacy medicalrecord.cppt (KUNJUNGAN, TANGGAL, SUBYEKTIF, OBYEKTIF,
     * ASSESMENT, PLANNING, INSTRUKSI, TENAGA_MEDIS, OLEH) dan
     * medicalrecord.verifikasi_cppt (KUNJUNGAN, BATAS_TANGGAL, TANGGAL, OLEH,
     * STATUS). Kolom alur SBAR/TBAK/baca/konfirmasi legacy tidak dibawa —
     * itu state presentasi yang di SIMGOS hidup di lapisan baca, bukan tabel.
     *
     * CPPT append-only: tanpa rute update/delete (seperti VitalSign). Koreksi
     * = baris baru; penghapusan histori = lewat amendment episode.
     */
    public function up(): void
    {
        Schema::create('cppt_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->dateTime('recorded_at');
            $table->text('subjective')->nullable();
            $table->text('objective')->nullable();
            $table->text('assessment')->nullable();
            $table->text('plan')->nullable();
            $table->text('instruction')->nullable();
            $table->string('profession', 50)->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('employees')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('cppt_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->date('valid_until');
            $table->dateTime('verified_at');
            $table->foreignId('verified_by')->constrained('employees')->cascadeOnDelete();
            $table->string('status')->default('verified');
            $table->timestamps();

            $table->unique(['visit_id', 'valid_until']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cppt_verifications');
        Schema::dropIfExists('cppt_entries');
    }
};
