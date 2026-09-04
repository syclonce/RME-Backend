<?php

namespace Modules\MedicalRecordAdmissionMedicationReconciliation\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\MedicalRecordAdmissionMedicationReconciliation\Models\AdmissionMedicationReconciliation;

/**
 * State machine rekonsiliasi obat saat admisi — pola LabOrderService/SurgeryService:
 * TRANSITIONS map, lockForUpdate + cek status ganda, gerbang RME lewat MedicalRecordGate.
 *
 * Nilai status ('draft','completed') berasal dari StoreAdmissionMedicationReconciliationRequest
 * (rules 'status' => in:draft,completed) — draft dibuat sistem, completed adalah verifikasi
 * akhir farmasi/dokter atas daftar obat yang direkonsiliasi (tidak bisa dibatalkan kembali
 * ke draft karena itu adalah pencatatan legal, bukan draft berulang).
 */
class AdmissionMedicationReconciliationService
{
    private const TRANSITIONS = [
        'draft' => ['completed'],
        'completed' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): AdmissionMedicationReconciliation
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => AdmissionMedicationReconciliation::create([
            ...Arr::except($data, 'status'),
            'reconciled_at' => $data['reconciled_at'] ?? now(),
            'status' => 'draft',
            'created_by' => $user->id,
        ]));
    }

    public function transition(AdmissionMedicationReconciliation $record, string $target, User $user): AdmissionMedicationReconciliation
    {
        $this->medicalRecordGate->assertWritable((int) $record->visit_id, $user);
        $allowed = self::TRANSITIONS[$record->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi rekonsiliasi obat {$record->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($record, $target) {
            $locked = AdmissionMedicationReconciliation::query()->whereKey($record->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status rekonsiliasi obat sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
