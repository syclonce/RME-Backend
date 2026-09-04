<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient_family_contacts', function (Blueprint $table) {
            $table->foreign('patient_family_id')->references('id')->on('patient_families')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('patient_family_contacts', function (Blueprint $table) {
            $table->dropForeign(['patient_family_id']);
        });
    }
};
