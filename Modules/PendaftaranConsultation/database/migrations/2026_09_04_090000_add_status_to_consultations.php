<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Status konsul — tanpa ini tidak ada cara mengetahui konsul mana yang belum dijawab.
 *
 * Legacy memisahkan Pengiriman (`/pendaftaran/konsul`) dari Feedback
 * (`/pendaftaran/jawabankonsul`), dan memakai `konsul.STATUS` (referensi JENIS 31)
 * dengan nilai [1,2] sebagai penanda "masih berjalan" — itulah yang membuat unit
 * tujuan punya daftar kerja. Tabel `consultations` SIMGOS punya `question` tetapi
 * tidak punya status sama sekali, sehingga konsul terkirim dan konsul terjawab tidak
 * dapat dibedakan.
 *
 * `answered_at` diturunkan (bukan sumber kebenaran) agar daftar "menunggu jawaban"
 * dapat difilter tanpa join ke `consultation_answers`.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            // pending   = terkirim, menunggu unit tujuan
            // answered  = sudah dijawab
            // cancelled = ditarik pengirim sebelum dijawab
            $table->string('status')->default('pending')->after('question');
            $table->dateTime('answered_at')->nullable()->after('status');
            $table->foreignId('requested_by')->nullable()->after('answered_at')
                ->constrained('users')->nullOnDelete();

            $table->index(['consulted_department_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropIndex(['consulted_department_id', 'status']);
            $table->dropConstrainedForeignId('requested_by');
            $table->dropColumn(['status', 'answered_at']);
        });
    }
};
