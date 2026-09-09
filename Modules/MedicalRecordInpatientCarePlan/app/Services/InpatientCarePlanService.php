<?php

namespace Modules\MedicalRecordInpatientCarePlan\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\MedicalRecordInpatientCarePlan\Models\InpatientCarePlan;

/**
 * State machine rencana asuhan rawat inap — pola LabOrderService/SurgeryService:
 * TRANSITIONS map, lockForUpdate + cek status ganda, gerbang RME lewat MedicalRecordGate.
 *
 * Nilai status ('active','completed','revised') berasal dari
 * StoreInpatientCarePlanRequest (rules 'status' => in:active,completed,revised).
 * 'revised' berarti rencana diubah di tengah perawatan (target LOS/tujuan berubah)
 * — masih bisa lanjut ke completed. 'completed' adalah akhir episode rencana
 * (pasien pulang / tujuan tercapai) dan tidak dapat diubah lagi.
 */
class InpatientCarePlanService
{
    private const TRANSITIONS = [
        'active' => ['completed', 'revised'],
        'revised' => ['completed'],
        'completed' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): InpatientCarePlan
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => InpatientCarePlan::create([
            ...Arr::except($data, 'status'),
            'planned_at' => $data['planned_at'] ?? now(),
            'status' => 'active',
            'created_by' => $user->id,
        ]));
    }

    public function transition(InpatientCarePlan $record, string $target, User $user): InpatientCarePlan
    {
        $this->medicalRecordGate->assertWritable((int) $record->visit_id, $user);
        $allowed = self::TRANSITIONS[$record->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi rencana asuhan {$record->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($record, $target) {
            $locked = InpatientCarePlan::query()->whereKey($record->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status rencana asuhan sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
