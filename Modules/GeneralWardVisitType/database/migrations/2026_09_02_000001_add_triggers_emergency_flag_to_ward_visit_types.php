<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * `triggers_emergency_flag`: menandai jenis kunjungan ruangan yang berarti
     * "gawat darurat/IGD" secara semantik — dipakai backend/frontend untuk
     * otomatis menyalakan `is_emergency` di Registrasi saat petugas memilih
     * ruangan tujuan dengan jenis kunjungan ini di wizard Pendaftaran
     * Kunjungan. Bukan field UI biasa (bukan sekadar label tampilan), makanya
     * dinamai eksplisit "_flag" supaya tidak tertukar dengan kolom
     * kosmetik/urutan lain kalau modul ini nanti tumbuh.
     */
    public function up(): void
    {
        Schema::table('ward_visit_types', function (Blueprint $table) {
            $table->boolean('triggers_emergency_flag')->default(false)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('ward_visit_types', function (Blueprint $table) {
            $table->dropColumn('triggers_emergency_flag');
        });
    }
};
