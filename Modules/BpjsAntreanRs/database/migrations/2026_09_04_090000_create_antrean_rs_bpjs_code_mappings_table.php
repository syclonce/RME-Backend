<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel pemetaan kode referensi BPJS (kodepoli/kodedokter) untuk ward
     * (poli) dan employee (dokter) internal SIMGOS.
     *
     * KEPUTUSAN (pemilik repo, 2026-09-04): pemetaan TIDAK disimpan sebagai
     * kolom langsung di tabel wards/employees (opsi A ditolak), tapi sebagai
     * tabel terpisah (opsi B), karena:
     *   1. Satu ward/employee bisa punya lebih dari satu kode BPJS berlaku
     *      pada waktu berbeda (mis. dokter pindah kodedokter setelah
     *      re-kredensialing BPJS, atau poli dipecah/digabung).
     *   2. Riwayat perubahan kode harus terjaga (audit) — kolom tunggal akan
     *      menimpa (overwrite) kode lama tanpa jejak.
     *
     * Satu baris memetakan SALAH SATU dari ward_id atau employee_id (bukan
     * dua-duanya) ke kode BPJS. Ini disengaja: kodepoli dan kodedokter adalah
     * dua ruang kode BPJS yang berbeda (poli vs dokter di WS Antrean Online),
     * jadi dipetakan lewat baris terpisah, bukan satu baris ward+employee.
     */
    public function up(): void
    {
        Schema::create('antrean_rs_bpjs_code_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_id')->nullable()->constrained('wards')->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->cascadeOnDelete();
            $table->string('bpjs_code', 20);
            $table->string('bpjs_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('valid_from')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            // Satu ward atau employee hanya boleh punya SATU baris aktif pada
            // satu waktu — mencegah kodepoli/kodedokter ganda yang ambigu
            // saat draf antrean menurunkan kode dari pemetaan. Riwayat kode
            // lama tetap ada, cukup dinonaktifkan (is_active = false), bukan
            // dihapus, supaya jejak perubahan terjaga (lihat catatan di atas).
            //
            // Diimplementasikan sebagai unique index parsial via raw SQL
            // karena Laravel Schema builder tidak mendukung partial unique
            // index secara native untuk MySQL/PostgreSQL sekaligus; sebagai
            // gantinya keunikan "hanya satu aktif" ditegakkan di lapisan
            // aplikasi (service), sedangkan index di sini menjaga tidak ada
            // ward/employee yang sama dipetakan ke waktu berlaku (valid_from)
            // yang sama persis.
            $table->unique(['ward_id', 'valid_from'], 'antrean_rs_bpjs_code_mappings_ward_valid_from_unique');
            $table->unique(['employee_id', 'valid_from'], 'antrean_rs_bpjs_code_mappings_employee_valid_from_unique');
        });

        // Aturan "satu baris HARUS memetakan salah satu (ward_id XOR
        // employee_id)" SENGAJA tidak dipasang sebagai CHECK constraint di
        // sini: test suite proyek ini jalan di atas SQLite (phpunit.xml),
        // yang tidak mendukung ALTER TABLE ... ADD CONSTRAINT CHECK, dan
        // environment produksi bisa MySQL atau PostgreSQL — dua dialek
        // dengan sintaks CHECK berbeda. Aturan ini ditegakkan di
        // BpjsCodeMappingService::save() sebelum tiap tulis, bukan di
        // database.
    }

    public function down(): void
    {
        Schema::dropIfExists('antrean_rs_bpjs_code_mappings');
    }
};
