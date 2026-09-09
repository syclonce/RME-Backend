<?php

namespace Modules\SatuSehat\Observers;

use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\SatuSehat\Services\SatuSehatOutboxService;

/**
 * Antrekan FHIR Procedure saat tindakan medis dicatat atau diubah.
 *
 * Tidak ada event domain untuk MedicalProcedure (`EventServiceProvider` modul
 * `LayananMedicalProcedure` kosong) — dipakai model observer `saved`. Route
 * menyediakan store DAN update, dan status tindakan (`completed`/dibatalkan)
 * bisa berubah setelah dicatat, jadi `saved` (bukan `created` saja) diperlukan
 * supaya perubahan status ikut terkirim ulang — sama seperti alasan
 * `SatuSehatOutboxService::enqueue` memperbarui payload submission yang masih
 * pending/failed, bukan cuma membuat baru.
 */
class QueueProcedureOnMedicalProcedureSaved
{
    public function __construct(protected SatuSehatOutboxService $outbox) {}

    public function saved(MedicalProcedure $medicalProcedure): void
    {
        $this->outbox->enqueue('Procedure', $medicalProcedure, [
            'medical_procedure_id' => $medicalProcedure->id,
            'visit_id' => $medicalProcedure->visit_id,
            'service_id' => $medicalProcedure->service_id,
            'performed_at' => optional($medicalProcedure->performed_at)->toIso8601String(),
            'performed_by' => $medicalProcedure->performed_by,
            'status' => $medicalProcedure->status,
        ]);
    }
}
