<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Ganti kolom string bebas `identity_type` jadi FK ke data master
     * `identity_card_types` (Modules/GeneralIdentityCardType) — konsisten
     * dengan pola relasi lain (gender_id, religion_id, dst) yang pakai tabel
     * referensi, bukan enum/string bebas. Data lama (kalau ada, dari uji
     * manual sesi sebelumnya) di-drop karena masih fase development dan tidak
     * ada pemetaan otomatis string -> id yang aman.
     */
    public function up(): void
    {
        Schema::table('patient_identity_cards', function (Blueprint $table) {
            $table->dropColumn('identity_type');
        });

        Schema::table('patient_identity_cards', function (Blueprint $table) {
            $table->unsignedBigInteger('identity_card_type_id')->nullable()->after('patient_id');
            $table->foreign('identity_card_type_id')->references('id')->on('identity_card_types')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_identity_cards', function (Blueprint $table) {
            $table->dropForeign(['identity_card_type_id']);
            $table->dropColumn('identity_card_type_id');
        });

        Schema::table('patient_identity_cards', function (Blueprint $table) {
            $table->string('identity_type')->nullable()->after('patient_id');
        });
    }
};
