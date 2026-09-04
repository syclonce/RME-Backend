<?php

namespace Modules\SatuSehat\Observers;

use Modules\MedicalRecordVitalSign\Models\VitalSign;
use Modules\SatuSehat\Services\SatuSehatOutboxService;

/**
 * Antrekan FHIR Observation saat tanda vital dicatat.
 *
 * Tidak ada event domain untuk VitalSign (`EventServiceProvider` modul
 * `MedicalRecordVitalSign` kosong) — dipakai model observer `created`.
 * VitalSign memang append-only (lihat komentar `VitalSignController::store`:
 * "legal medical record - append-only, no update/delete"), jadi `created`
 * adalah satu-satunya titik siklus hidup yang perlu diantrekan.
 *
 * Satu baris `vital_signs` berisi beberapa pengukuran sekaligus (suhu, nadi,
 * tekanan darah, dst) yang di FHIR masing-masing adalah Observation terpisah —
 * pemecahan itu tugas worker pengirim, bukan observer ini. Payload di sini
 * membawa seluruh baris apa adanya.
 */
class QueueObservationOnVitalSignCreated
{
    public function __construct(protected SatuSehatOutboxService $outbox) {}

    public function created(VitalSign $vitalSign): void
    {
        $this->outbox->enqueue('Observation', $vitalSign, [
            'vital_sign_id' => $vitalSign->id,
            'visit_id' => $vitalSign->visit_id,
            'recorded_at' => optional($vitalSign->recorded_at)->toIso8601String(),
            'temperature' => $vitalSign->temperature,
            'pulse' => $vitalSign->pulse,
            'respiratory_rate' => $vitalSign->respiratory_rate,
            'systolic' => $vitalSign->systolic,
            'diastolic' => $vitalSign->diastolic,
            'oxygen_saturation' => $vitalSign->oxygen_saturation,
            'pain_scale' => $vitalSign->pain_scale,
            'recorded_by' => $vitalSign->recorded_by,
        ]);
    }
}
