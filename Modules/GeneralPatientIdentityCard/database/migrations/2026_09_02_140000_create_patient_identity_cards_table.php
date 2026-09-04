<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_identity_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->string('identity_type'); // KTP, KK, SIM, Passport, dll
            $table->string('identity_number');
            // Alamat sesuai kartu identitas - bisa berbeda dari alamat domisili
            // pasien saat ini (kolom address/rt/rw/postal_code/village_id di
            // tabel patients). Nullable karena diisi hanya kalau petugas
            // mencentang bahwa alamat KTP berbeda dari alamat sekarang.
            $table->string('address')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->boolean('is_same_as_current_address')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_identity_cards');
    }
};
