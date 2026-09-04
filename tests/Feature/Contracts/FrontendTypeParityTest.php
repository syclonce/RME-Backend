<?php

namespace Tests\Feature\Contracts;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Tipe frontend harus memuat setiap kolom yang dikembalikan backend.
 *
 * Ada karena satu cacat yang sama ditemukan tiga kali dalam satu sesi:
 * `LabOrder.status`, `RadiologyOrder.modality`, `ServiceHandover.status` —
 * semuanya ada di database dan digerakkan state machine, tapi hilang dari
 * `types.ts`, sehingga layar tidak dapat menampilkannya sama sekali.
 *
 * Penyebabnya bukan tiga kelalaian terpisah: tipe frontend disalin dari kolom
 * yang kebetulan dipakai scaffold, bukan diturunkan dari model backend.
 * Penyapuan menyeluruh menemukan 95 modul dengan cacat yang sama, 169 field.
 *
 * Tes ini menjaga modul-modul yang layarnya BERGANTUNG pada kolom itu. Sengaja
 * tidak menyapu seluruh 606 modul: sebagian besar layarnya masih CRUD generik
 * yang membaca apa pun yang datang, dan menguncinya sekarang hanya akan
 * membuat tes ini gagal setiap kali ada migrasi baru.
 */
class FrontendTypeParityTest extends TestCase
{
    // Butuh skema sungguhan: tesnya memeriksa kolom, bukan data.
    use RefreshDatabase;

    /** @return array<string, array{0:string,1:string,2:array<int,string>}> */
    public static function guardedModules(): array
    {
        return [
            'LabOrder' => ['LayananLabOrder', 'lab_orders', ['status', 'is_emergency', 'order_number']],
            'RadiologyOrder' => ['LayananRadiologyOrder', 'radiology_orders', ['status', 'modality', 'body_part']],
            'ServiceHandover' => ['PendaftaranServiceHandover', 'service_handovers', ['status']],
            'WardQueue' => ['PendaftaranWardQueue', 'ward_queues', ['status', 'called_at']],
            'MedicalProcedure' => ['LayananMedicalProcedure', 'medical_procedures', ['status']],
            'Diagnosis' => ['MedicalRecordDiagnosis', 'diagnoses', ['is_primary', 'diagnosis_code_id']],
            'VitalSign' => ['MedicalRecordVitalSign', 'vital_signs', ['systolic', 'diastolic', 'pain_scale']],
            'Anamnesis' => ['MedicalRecordAnamnesis', 'anamneses', ['allergy_history', 'recorded_at']],
        ];
    }

    /**
     * @param  array<int, string>  $columns
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('guardedModules')]
    public function test_frontend_type_declares_backend_columns(string $module, string $table, array $columns): void
    {
        $typeFile = base_path("../RME-Frontend/src/features/{$module}/types.ts");

        if (! is_file($typeFile)) {
            $this->markTestSkipped("RME-Frontend tidak tersedia di lingkungan ini ({$module}).");
        }

        $source = file_get_contents($typeFile);

        foreach ($columns as $column) {
            $this->assertTrue(
                Schema::hasColumn($table, $column),
                "Kolom {$table}.{$column} tidak ada — perbarui daftar tes ini, bukan tipenya.",
            );

            $this->assertMatchesRegularExpression(
                '/^\s*'.preg_quote($column, '/').'\??:/m',
                $source,
                "Tipe frontend {$module} tidak mendeklarasikan `{$column}`, padahal kolomnya "
                ."ada di `{$table}` dan dipakai layarnya. Layar tidak akan dapat menampilkannya.",
            );
        }
    }
}
