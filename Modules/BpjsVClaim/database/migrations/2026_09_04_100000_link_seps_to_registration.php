<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tautkan SEP ke pendaftaran dan kunjungan internal.
 *
 * Tabel `seps` sebelumnya hanya ber-FK ke `patients` dan `doctors` — tidak ada
 * jalan dari SEP ke pendaftaran yang menerbitkannya, maupun sebaliknya. Akibatnya
 * SEP hanya bisa dibuat sebagai CRUD lepas: petugas mengetik ulang nomor kartu,
 * poli, dan kelas rawat yang sebenarnya sudah tersimpan di pendaftaran.
 *
 * Legacy pun memisahkan keduanya (`bpjs.kunjungan` tanpa FK ke NOPEN, dijembatani
 * `mappingDataTransaksi`), tetapi itu kelemahannya — peta induk Temuan 11 mencatat
 * penautan legacy terjadi lewat join manual di SQL, bukan relasi yang dijaga.
 *
 * Keduanya nullable: SEP dapat lahir sebelum kunjungan dibuat (pasien datang
 * membawa rujukan), dan SEP historis hasil migrasi tidak punya pasangan internal.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seps', function (Blueprint $table) {
            $table->foreignId('registration_id')->nullable()->after('patient_id')
                ->constrained('registrations')->nullOnDelete();
            $table->foreignId('visit_id')->nullable()->after('registration_id')
                ->constrained('visits')->nullOnDelete();

            $table->index(['registration_id', 'local_status']);
        });
    }

    public function down(): void
    {
        Schema::table('seps', function (Blueprint $table) {
            $table->dropIndex(['registration_id', 'local_status']);
            $table->dropConstrainedForeignId('visit_id');
            $table->dropConstrainedForeignId('registration_id');
        });
    }
};
