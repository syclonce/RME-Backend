<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Port PasienService:357-413 simgos2: bayi dikenal wajib data Ibu (KTP ibu
     * wajib). Keluarga selama ini hanya nama+hubungan — nomor identitas ibu
     * tidak punya tempat. Kolom generik (bukan khusus-ibu) agar reusable untuk
     * identitas keluarga lain.
     */
    public function up(): void
    {
        Schema::table('patient_families', function (Blueprint $table) {
            $table->string('identity_number', 64)->nullable()->after('relationship');
        });
    }

    public function down(): void
    {
        Schema::table('patient_families', function (Blueprint $table) {
            $table->dropColumn('identity_number');
        });
    }
};
