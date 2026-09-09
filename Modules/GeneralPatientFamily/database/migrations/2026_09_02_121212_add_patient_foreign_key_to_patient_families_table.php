<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient_families', function (Blueprint $table) {
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('patient_families', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
        });
    }
};
