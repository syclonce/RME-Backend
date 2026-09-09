<?php

namespace Modules\SatuSehat\Observers;

use Modules\GeneralPatient\Models\Patient;
use Modules\SatuSehat\Services\SatuSehatOutboxService;

/**
 * Antrekan FHIR Patient saat data pasien dibuat atau diubah.
 *
 * Tidak ada event domain untuk siklus hidup Patient (`Modules\GeneralPatient`
 * memakai `Model::create()`/`update()` langsung di controller, `EventServiceProvider`
 * modul itu kosong) — dipakai model observer `saved`, bukan event baru, sesuai
 * arahan tugas untuk tidak menambah event kalau tidak perlu.
 *
 * `saved` (bukan `created` saja) karena SATUSEHAT perlu tahu perubahan data
 * demografis pasien (nama, NIK, alamat) yang terjadi setelah pendaftaran awal —
 * pola yang sama dengan alasan `enqueue()` tidak memblokir kiriman baru pada
 * submission yang sudah `sent`.
 */
class QueuePatientOnSave
{
    public function __construct(protected SatuSehatOutboxService $outbox) {}

    public function saved(Patient $patient): void
    {
        // Payload sengaja minimal dan memakai ID internal. Pemetaan penuh ke
        // struktur FHIR (termasuk NIK -> identifier, penukaran ke IHS ID) adalah
        // tugas worker pengirim, bukan observer ini.
        $this->outbox->enqueue('Patient', $patient, [
            'patient_id' => $patient->id,
            'medical_record_number' => $patient->medical_record_number,
            'nik' => $patient->nik,
            'name' => $patient->name,
            'birth_date' => optional($patient->birth_date)->toDateString(),
            'gender_id' => $patient->gender_id,
            'is_unidentified' => $patient->is_unidentified,
        ]);
    }
}
