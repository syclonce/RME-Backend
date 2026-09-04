<?php

namespace Modules\SatuSehat\Observers;

use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\SatuSehat\Services\SatuSehatOutboxService;

/**
 * Antrekan FHIR Condition saat diagnosis dicatat.
 *
 * Tidak ada event domain untuk Diagnosis (`EventServiceProvider` modul
 * `MedicalRecordDiagnosis` kosong; controller memanggil `Diagnosis::create()`
 * langsung) — dipakai model observer `created`. Route hanya menyediakan
 * store/destroy (tidak ada update), jadi `created` sudah cukup mewakili
 * seluruh siklus hidup normal diagnosis.
 */
class QueueConditionOnDiagnosisCreated
{
    public function __construct(protected SatuSehatOutboxService $outbox) {}

    public function created(Diagnosis $diagnosis): void
    {
        // Payload minimal, ID internal saja. Pemetaan kode ICD-10 ke sistem FHIR
        // dan penukaran ID pasien/praktisi ke IHS ID adalah tugas worker pengirim.
        $this->outbox->enqueue('Condition', $diagnosis, [
            'diagnosis_id' => $diagnosis->id,
            'visit_id' => $diagnosis->visit_id,
            'diagnosis_code_id' => $diagnosis->diagnosis_code_id,
            'is_primary' => $diagnosis->is_primary,
            'recorded_at' => optional($diagnosis->recorded_at)->toIso8601String(),
            'status' => $diagnosis->status,
        ]);
    }
}
