<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Menyemai `number_sequences` dari nomor yang SUDAH terbit.
 *
 * Tanpa ini, deret baru mulai dari 0 pada database yang sudah berisi data, dan
 * nomor pertama yang diterbitkannya menabrak nomor lama:
 *
 *     SQLSTATE[23000]: Duplicate entry 'RM-2026-000001'
 *       for key 'patients_medical_record_number_unique'
 *
 * (ditemukan saat memanggil POST /api/v1/patients pada server dev berisi 5.031
 * pasien; tes tidak menangkapnya karena RefreshDatabase selalu mulai kosong.)
 *
 * Hanya baris yang benar-benar berformat deret yang dibaca. Data lama di dev
 * memuat dua bentuk berbeda -- 'RM-9998260810' (seed acak, tanpa komponen
 * tahun) dan 'RM-2026-000001' (format generator). Mengambil "nomor terbesar"
 * begitu saja akan memungut yang pertama dan menyetel penghitung ke angka
 * yang tidak ada hubungannya dengan urutan tahun berjalan.
 */
return new class extends Migration
{
    /** @var array<int, array{0:string,1:string,2:string,3:string}> tabel, kolom, prefix, nama deret */
    private const SOURCES = [
        ['patients', 'medical_record_number', 'RM', 'medical_record_number'],
        ['registrations', 'registration_number', 'REG', 'registration'],
        ['visits', 'visit_number', 'KJ', 'visit'],
        ['invoices', 'invoice_number', 'INV', 'invoice'],
        ['payments', 'payment_number', 'PAY', 'payment'],
        ['prescriptions', 'prescription_number', 'RX', 'prescription'],
        ['lab_orders', 'order_number', 'LAB', 'lab_order'],
        ['deposits', 'deposit_number', 'DEP', 'deposit'],
        ['sales', 'sale_number', 'SAL', 'sale'],
        ['referrals', 'referral_number', 'RUJ', 'referral'],
        ['claim_files', 'claim_number', 'CLM', 'claim_file'],
        ['claim_invoices', 'claim_number', 'CLM', 'claim_invoice'],
        ['invoice_merges', 'merge_number', 'MRG', 'invoice_merge'],
        ['goods_receipts', 'receipt_number', 'REC', 'goods_receipt'],
        ['goods_returns', 'return_number', 'RTN', 'goods_return'],
        ['stock_requests', 'request_number', 'REQ', 'stock_request'],
        ['sterilization_cycles', 'cycle_number', 'CYC', 'sterilization_cycle'],
        ['document_cancellations', 'cancellation_number', 'DCN', 'document_cancellation'],
        ['medical_record_cancellations', 'cancellation_number', 'MRC', 'medical_record_cancellation'],
        ['return_cancellations', 'cancellation_number', 'RCN', 'return_cancellation'],
        ['final_result_cancellations', 'cancellation_number', 'FRC', 'final_result_cancellation'],
        ['goods_receipt_cancellations', 'cancellation_number', 'GRC', 'goods_receipt_cancellation'],
    ];

    public function up(): void
    {
        foreach (self::SOURCES as [$table, $column, $prefix, $sequence]) {
            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, $column)) {
                continue;
            }

            // Kumpulkan nomor tertinggi per tahun. Satu deret per tahun,
            // sesuai cakupan yang dipakai NumberSequence::format().
            $highest = [];

            DB::table($table)
                ->whereNotNull($column)
                ->orderBy('id')
                ->pluck($column)
                ->each(function ($number) use ($prefix, &$highest) {
                    // Hanya PREFIX-YYYY-NNNNNN; bentuk lain diabaikan.
                    if (! preg_match('/^'.preg_quote($prefix, '/').'-(\d{4})-(\d+)$/', (string) $number, $m)) {
                        return;
                    }

                    $year = $m[1];
                    $value = (int) $m[2];

                    if ($value > ($highest[$year] ?? 0)) {
                        $highest[$year] = $value;
                    }
                });

            foreach ($highest as $year => $value) {
                // updateOrInsert, bukan insert: migrasi ini harus aman dijalankan
                // ulang, dan tidak boleh menurunkan penghitung yang sudah maju.
                $current = (int) DB::table('number_sequences')
                    ->where('name', $sequence)->where('scope', $year)->value('value');

                if ($value <= $current) {
                    continue;
                }

                DB::table('number_sequences')->updateOrInsert(
                    ['name' => $sequence, 'scope' => (string) $year],
                    ['value' => $value, 'updated_at' => now(), 'created_at' => now()],
                );
            }
        }
    }

    public function down(): void
    {
        // Sengaja tidak mengosongkan number_sequences: menurunkan penghitung
        // akan menerbitkan ulang nomor yang sudah dipakai.
    }
};
