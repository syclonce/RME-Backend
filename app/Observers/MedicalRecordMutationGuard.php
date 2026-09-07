<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;

/**
 * Penegakan terpusat: tidak ada UPDATE/DELETE pada catatan rekam medis yang
 * episodenya sudah final, dari jalur mana pun (HTTP, job, console, tinker).
 *
 * Latar: 164/179 modul MedicalRecord punya `update`, 128 sudah guard `store`
 * via `GuardsMedicalRecord`, tetapi 0 guard `update` — cacat yang sama dengan
 * legacy SIMGOS2 (`isValidateBeforeUpdate` tidak pernah di-override di 177
 * resource). Menyalin 2 baris guard ke 160+ controller bisa, tetapi menyimpang
 * diam-diam saat modul baru lahir. Satu titik penegakan di sini + uji ratchet
 * (`MedicalRecordMutationGuardTest::cakupan_*`) membuat modul baru otomatis
 * terlindungi atau gagal test dengan pesan yang menunjuk ke daftar ini.
 *
 * Cara mengatasi yang sah tetap sama: `beginAmendment` (alasan wajib, versi+1)
 * lalu tulis sebagai `amending`. Koreksi tidak pernah menimpa histori.
 *
 * Yang SENGAJA tidak dijaga (tidak punya konteks episode):
 * - Registri pasien-longitudinal (`Allergy`) — alergi baru ditemukan setelah
 *   kunjungan final adalah data sah, bukan koreksi histori.
 * - Katalog master (Icd*, ExaminationType, ImplementationChecklistItem,
 *   NursingIndicator/Type, *IndicatorMapping) — bukan catatan episode.
 * - Operasional/admin (RecordFileLoan, RetentionSchedule) — bukan data klinis.
 */
class MedicalRecordMutationGuard
{
    /**
     * Rantai induk → visit untuk model anak tanpa `visit_id` sendiri.
     * Entri string = nama relasi BelongsTo pada model anak.
     * Entri ['model' => X, 'fk' => y] = cari induk langsung (relasi tak bertipe).
     * Rantai boleh bertingkat (InformationItem → information → consent).
     */
    public const PARENT_MAP = [
        \Modules\MedicalRecordAdmissionMedicationReconciliationItem\Models\AdmissionMedicationReconciliationItem::class => ['reconciliation'],
        \Modules\MedicalRecordDischargeMedicationReconciliationItem\Models\DischargeMedicationReconciliationItem::class => ['reconciliation'],
        \Modules\MedicalRecordTransferMedicationReconciliationItem\Models\TransferMedicationReconciliationItem::class => ['reconciliation'],
        \Modules\MedicalRecordAnamnesisSource\Models\AnamnesisSource::class => ['anamnesis'],
        \Modules\MedicalRecordBaepAnxietyDetail\Models\BaepAnxietyDetail::class => ['baepProtocol'],
        \Modules\MedicalRecordBaepCognitiveDetail\Models\BaepCognitiveDetail::class => ['baepProtocol'],
        \Modules\MedicalRecordBaepDepressionDetail\Models\BaepDepressionDetail::class => ['baepProtocol'],
        \Modules\MedicalRecordBaepDysphagiaDetail\Models\BaepDysphagiaDetail::class => ['baepProtocol'],
        \Modules\MedicalRecordBaepInsomniaDetail\Models\BaepInsomniaDetail::class => ['baepProtocol'],
        \Modules\MedicalRecordBaepMotorDetail\Models\BaepMotorDetail::class => ['baepProtocol'],
        \Modules\MedicalRecordBaepSensoryDetail\Models\BaepSensoryDetail::class => ['baepProtocol'],
        \Modules\MedicalRecordBaepStimulationProtocolDetail\Models\BaepStimulationProtocolDetail::class => ['baepProtocol'],
        \Modules\MedicalRecordBloodTransfusionDetail\Models\BloodTransfusionDetail::class => ['transfusion'],
        \Modules\MedicalRecordBloodTransfusionObservation\Models\BloodTransfusionObservation::class => [
            ['model' => \Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion::class, 'fk' => 'blood_transfusion_id'],
        ],
        \Modules\MedicalRecordClinicalNoteCoManagement\Models\ClinicalNoteCoManagement::class => ['clinicalNote'],
        \Modules\MedicalRecordClinicalNoteVerification\Models\ClinicalNoteVerification::class => ['clinicalNote'],
        \Modules\MedicalRecordDiagnosisIndicatorMapping\Models\DiagnosisIndicatorMapping::class => [
            ['model' => \Modules\MedicalRecordDiagnosis\Models\Diagnosis::class, 'fk' => 'diagnosis_id'],
        ],
        \Modules\MedicalRecordFluidBalanceAssessmentDetail\Models\FluidBalanceAssessmentDetail::class => [
            ['model' => \Modules\MedicalRecordFluidBalanceAssessment\Models\FluidBalanceAssessment::class, 'fk' => 'fluid_balance_assessment_id'],
        ],
        \Modules\MedicalRecordImageMarkerPoint\Models\ImageMarkerPoint::class => [
            ['model' => \Modules\MedicalRecordImageMarker\Models\ImageMarker::class, 'fk' => 'image_marker_id'],
        ],
        \Modules\MedicalRecordInterventionProtocolDetail\Models\InterventionProtocolDetail::class => ['protocol'],
        \Modules\MedicalRecordLabResultSummaryItem\Models\LabResultSummaryItem::class => ['summary'],
        \Modules\MedicalRecordRadiologyResultSummaryItem\Models\RadiologyResultSummaryItem::class => ['summary'],
        \Modules\MedicalRecordNursingImplementation\Models\NursingImplementation::class => ['nursingDiagnosis'],
        \Modules\MedicalRecordNursingCarePlanImplementation\Models\NursingCarePlanImplementation::class => ['nursingCarePlan'],
        \Modules\MedicalRecordProcedureConsentInformation\Models\ProcedureConsentInformation::class => ['consent'],
        \Modules\MedicalRecordProcedureConsentInformationGiver\Models\ProcedureConsentInformationGiver::class => ['consent'],
        \Modules\MedicalRecordProcedureConsentInformationReceiver\Models\ProcedureConsentInformationReceiver::class => ['consent'],
        \Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Models\ProcedureConsentPatientAcknowledgement::class => ['consent'],
        \Modules\MedicalRecordProcedureConsentInformationItem\Models\ProcedureConsentInformationItem::class => ['information', 'consent'],
        \Modules\MedicalRecordRehabilitationProcedureExaminationItem\Models\RehabilitationProcedureExaminationItem::class => [
            ['model' => \Modules\MedicalRecordRehabilitationProcedureExamination\Models\RehabilitationProcedureExamination::class, 'fk' => 'rehabilitation_procedure_examination_id'],
        ],
        \Modules\MedicalRecordTranscranialDopplerWindow\Models\TranscranialDopplerWindow::class => [
            ['model' => \Modules\MedicalRecordTranscranialDopplerExamination\Models\TranscranialDopplerExamination::class, 'fk' => 'transcranial_doppler_examination_id'],
        ],
    ];

    /** Model MR yang disengaja tidak dijaga + alasan (dipakai uji ratchet). */
    public const EXCLUDED = [
        // Mesin lifecycle episode — justru mekanisme yang MENGUBAH status
        // (finalize/amend meng-update baris episode + menulis transition).
        // Menjaganya berarti beginAmendment memblokir dirinya sendiri.
        \Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode::class => 'mesin lifecycle episode (finalize/amend)',
        \Modules\MedicalRecordEpisode\Models\MedicalRecordEpisodeTransition::class => 'jejak audit transisi episode — justru bukti finalisasi',
        \Modules\MedicalRecordAllergy\Models\Allergy::class => 'registri longitudinal pasien, bukan catatan episode',
        \Modules\MedicalRecordIcd10Code\Models\Icd10Code::class => 'katalog master',
        \Modules\MedicalRecordIcd9CmCode\Models\Icd9CmCode::class => 'katalog master',
        \Modules\MedicalRecordIcd10CauseOfDeathCode\Models\Icd10CauseOfDeathCode::class => 'katalog master',
        \Modules\MedicalRecordExaminationType\Models\ExaminationType::class => 'katalog master',
        \Modules\MedicalRecordImplementationChecklistItem\Models\ImplementationChecklistItem::class => 'katalog master',
        \Modules\MedicalRecordNursingIndicator\Models\NursingIndicator::class => 'katalog master',
        \Modules\MedicalRecordNursingIndicatorType\Models\NursingIndicatorType::class => 'katalog master',
        \Modules\MedicalRecordInterventionIndicatorMapping\Models\InterventionIndicatorMapping::class => 'katalog master',
        \Modules\MedicalRecordRecordFileLoan\Models\RecordFileLoan::class => 'operasional peminjaman berkas, bukan data klinis',
        \Modules\MedicalRecordRetentionSchedule\Models\RetentionSchedule::class => 'jadwal admin, bukan data klinis',
    ];

    public static function register(): void
    {
        // Wildcard: Model::updating() pada class dasar TIDAK menjalar ke
        // subclass (nama event mengikat FQCN pendaftar). Listener wildcard
        // 'eloquent.*: *' menerima ($event, $payload) dengan $payload[0] model.
        // Filter namespace di dalam — murah, dan modul MR baru otomatis
        // terlindungi tanpa didaftarkan di mana pun.
        Event::listen(
            'eloquent.updating: *',
            fn (string $event, array $payload) => static::blockWhenFinalized($payload[0], 'mengubah')
        );
        Event::listen(
            'eloquent.deleting: *',
            fn (string $event, array $payload) => static::blockWhenFinalized($payload[0], 'menghapus')
        );
    }

    protected static function blockWhenFinalized(Model $model, string $aksi): void
    {
        // Mesin episode + pengecualian eksplisit tidak pernah digerbang
        // (lihat EXCLUDED) — tanpanya beginAmendment memblokir dirinya sendiri.
        if (isset(static::EXCLUDED[$model::class])) {
            return;
        }

        $visitId = static::resolveVisitId($model);

        if ($visitId === null) {
            return;
        }

        $isFinalized = MedicalRecordEpisode::query()
            ->where('visit_id', $visitId)
            ->where('status', MedicalRecordEpisode::STATUS_FINALIZED)
            ->exists();

        abort_if(
            $isFinalized,
            422,
            "Tidak dapat {$aksi} catatan: RME kunjungan ini sudah final. Gunakan jalur amendment sebelum mencatat koreksi."
        );
    }

    public static function resolveVisitId(Model $model): ?int
    {
        if (! str_starts_with($model::class, 'Modules\\MedicalRecord')) {
            return null;
        }

        // Jalur langsung: 137 model membawa visit_id sendiri. getAttribute pada
        // model tanpa kolom itu mengembalikan null — aman, bukan error.
        $direct = $model->getAttribute('visit_id');

        if ($direct !== null) {
            return (int) $direct;
        }

        // Jalur anak: telusuri rantai induk (mendukung bertingkat, mis.
        // InformationItem → information → consent) sampai ketemu visit_id.
        $current = $model;

        foreach (static::PARENT_MAP[$model::class] ?? [] as $step) {
            if (is_array($step)) {
                $current = ($step['model'])::query()->find($current->getAttribute($step['fk']));
            } else {
                try {
                    $current = $current->{$step};
                } catch (\Throwable) {
                    return null;
                }
            }

            if (! $current instanceof Model) {
                return null;
            }

            $visitId = $current->getAttribute('visit_id');

            if ($visitId !== null) {
                return (int) $visitId;
            }
        }

        return null;
    }
}
