<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom "siapa & kapan" untuk notifikasi/pengakuan nilai kritis. Kolom
     * notified_to/notified_at/acknowledged lama tetap dipakai (notified_to
     * tetap teks bebas: nama/unit tujuan pemberitahuan, misalnya lewat
     * telepon — bukan selalu user bersistem). Kolom baru di sini mencatat
     * user Sanctum yang MELAKUKAN aksi (menandai notified / acknowledged)
     * untuk jejak audit siapa-menekan-tombol, terpisah dari "kepada siapa
     * nilai itu disampaikan".
     */
    public function up(): void
    {
        Schema::table('critical_lab_values', function (Blueprint $table) {
            $table->foreignId('notified_by')->nullable()->after('notified_at')->constrained('users')->nullOnDelete();
            $table->foreignId('acknowledged_by')->nullable()->after('acknowledged')->constrained('users')->nullOnDelete();
            $table->dateTime('acknowledged_at')->nullable()->after('acknowledged_by');
        });
    }

    public function down(): void
    {
        Schema::table('critical_lab_values', function (Blueprint $table) {
            $table->dropConstrainedForeignId('notified_by');
            $table->dropConstrainedForeignId('acknowledged_by');
            $table->dropColumn('acknowledged_at');
        });
    }
};
