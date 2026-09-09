<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * Menyejajarkan status pembatalan final hasil dengan legacy.
 *
 * Tabel legacy `pembatalan.pembatalan_final_hasil` tidak punya kolom STATUS:
 * insert = batal. Default 'pending' di sini adalah sisa scaffold, bukan hasil
 * port -- dan menyesatkan, karena catatan 'pending' terlihat seolah menunggu
 * persetujuan yang tidak pernah ada dalam alurnya.
 *
 * Baris lama dinaikkan ke 'applied': pada versi sebelumnya, insert memang
 * satu-satunya jalan membuat baris ini, sama seperti legacy.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('final_result_cancellations', function (Blueprint $table) {
            $table->string('status')->default('applied')->change();
        });

        DB::table('final_result_cancellations')
            ->whereIn('status', ['pending', 'approved'])
            ->update(['status' => 'applied']);
    }

    public function down(): void
    {
        Schema::table('final_result_cancellations', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });
    }
};
