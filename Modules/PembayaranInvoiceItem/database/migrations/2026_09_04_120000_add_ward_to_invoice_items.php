<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Unit yang mengerjakan sebuah baris tagihan.
 *
 * KEPUTUSAN (pemilik repo, 2026-09-04): tagihan harus dapat dipecah per unit,
 * TETAPI tanpa menerbitkan kunjungan baru setiap kali pasien dimutasi — bentuk
 * yang lebih sederhana dari legacy.
 *
 * Legacy mencapai pemisahan itu lewat `kunjungan.REF`: tiap perpindahan melahirkan
 * kunjungan sendiri, dan tagihan mengikuti kunjungan. Konsekuensinya satu episode
 * rawat inap dapat pecah menjadi banyak kunjungan, dan menyatukannya kembali
 * membutuhkan `tagihan_pendaftaran` (many-to-many) — kerumitan yang tidak perlu
 * ditiru.
 *
 * Di sini penandanya dipindah ke BARIS TAGIHAN. Satu kunjungan tetap satu, tetapi
 * tiap tindakan/akomodasi membawa unit pengerjanya sendiri, sehingga laporan
 * pendapatan per unit tetap bisa dibuat.
 *
 * Nullable: baris lama dan baris yang memang tidak terikat unit (mis. administrasi
 * pendaftaran) tetap sah.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->foreignId('ward_id')->nullable()->after('service_id')
                ->constrained('wards')->nullOnDelete();

            $table->index(['invoice_id', 'ward_id']);
        });
    }

    public function down(): void
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropIndex(['invoice_id', 'ward_id']);
            $table->dropConstrainedForeignId('ward_id');
        });
    }
};
