<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;

/**
 * State machine pemeriksaan BAEP (Brainstem Auditory Evoked Potential) — pola
 * LabOrderService/SurgeryService: TRANSITIONS map, lockForUpdate + cek status
 * ganda, gerbang RME lewat MedicalRecordGate.
 *
 * Nilai status ('in_progress','completed') berasal dari
 * StoreBaepInterventionProtocolRequest (rules 'status' => in:in_progress,completed).
 * completed adalah pencatatan hasil akhir (interpretasi + latensi gelombang) dan final.
 */
class BaepInterventionProtocolService
{
    private const TRANSITIONS = [
        'in_progress' => ['completed'],
        'completed' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): BaepInterventionProtocol
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => BaepInterventionProtocol::create([
            ...Arr::except($data, 'status'),
            'performed_at' => $data['performed_at'] ?? now(),
            'status' => 'in_progress',
            'created_by' => $user->id,
        ]));
    }

    public function transition(BaepInterventionProtocol $record, string $target, User $user, array $extra = []): BaepInterventionProtocol
    {
        $this->medicalRecordGate->assertWritable((int) $record->visit_id, $user);
        $allowed = self::TRANSITIONS[$record->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi BAEP {$record->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($record, $target, $extra) {
            $locked = BaepInterventionProtocol::query()->whereKey($record->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status BAEP sudah berubah.');
            $locked->update([
                ...Arr::only($extra, [
                    'click_rate_hz',
                    'stimulus_intensity_db',
                    'wave_i_latency_ms',
                    'wave_iii_latency_ms',
                    'wave_v_latency_ms',
                    'interpretation',
                ]),
                'status' => $target,
            ]);

            return $locked->refresh();
        });
    }
}
