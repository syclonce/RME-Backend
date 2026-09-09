<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient_identity_cards', function (Blueprint $table) {
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreign('village_id')->references('id')->on('indonesia_villages')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('patient_identity_cards', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['village_id']);
        });
    }
};
