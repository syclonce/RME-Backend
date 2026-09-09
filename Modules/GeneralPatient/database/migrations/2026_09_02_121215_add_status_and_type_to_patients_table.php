<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->foreignId('patient_status_id')->nullable()->after('is_unidentified')
                ->constrained('patient_statuses')->nullOnDelete();
            $table->foreignId('patient_type_id')->nullable()->after('is_unidentified')
                ->constrained('patient_types')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropConstrainedForeignId('patient_status_id');
            $table->dropConstrainedForeignId('patient_type_id');
        });
    }
};
