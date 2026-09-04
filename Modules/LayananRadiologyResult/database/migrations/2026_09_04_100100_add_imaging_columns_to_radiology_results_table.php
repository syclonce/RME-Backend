<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migrasi TAMBAHAN untuk menyerap dua kolom ImagingStudy yang belum ditampung
 * RadiologyResult (keputusan pemilik repo 2026-09-04). Kolom ImagingStudy
 * lain sudah punya padanan di radiology_results: performed_at ~ examined_at,
 * findings_summary ~ findings, jadi TIDAK diduplikasi — hanya dua kolom di
 * bawah ini yang benar-benar baru.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('radiology_results', function (Blueprint $table) {
            // Placeholder Study Instance UID dari PACS nyata (masa depan).
            // Unique bila terisi karena UID memang identitas global studi
            // di dunia DICOM — port persis dari imaging_studies.
            $table->string('study_instance_uid')->nullable()->unique()->after('radiology_order_id');
            $table->string('report_url')->nullable()->after('impression');
        });
    }

    public function down(): void
    {
        Schema::table('radiology_results', function (Blueprint $table) {
            $table->dropColumn(['study_instance_uid', 'report_url']);
        });
    }
};
