<?php

namespace Modules\MedicalRecordSurgery\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\MedicalRecordSurgery\Models\Surgery;

/**
 * State machine operasi — meniru pola LabOrderService/RadiologyOrderService
 * (Modules/LayananLabOrder, Modules/LayananRadiologyOrder): TRANSITIONS map,
 * lockForUpdate + cek status ganda (sebelum & sesudah lock), gerbang RME lewat
 * MedicalRecordGate.
 *
 * Sebelumnya SurgeryController menulis status langsung lewat update() tanpa
 * gerbang apapun — operasi bisa dicatat pada kunjungan yang RME-nya sudah
 * final, dan status bisa dipaksa lompat (mis. scheduled -> completed tanpa
 * pernah berlangsung).
 */
class SurgeryService
{
    private const TRANSITIONS = [
        'scheduled' => ['in_progress', 'cancelled'],
        'in_progress' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): Surgery
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => Surgery::create([
            ...Arr::except($data, 'status'),
            'status' => 'scheduled',
            'created_by' => $user->id,
        ]));
    }

    public function transition(Surgery $surgery, string $target, User $user, array $extra = []): Surgery
    {
        $this->medicalRecordGate->assertWritable((int) $surgery->visit_id, $user);
        $allowed = self::TRANSITIONS[$surgery->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi operasi {$surgery->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($surgery, $target, $extra) {
            $locked = Surgery::query()->whereKey($surgery->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status operasi sudah berubah.');
            $locked->update([
                ...Arr::only($extra, ['ended_at', 'notes']),
                'status' => $target,
            ]);

            if ($target === 'in_progress' && $locked->started_at === null) {
                $locked->update(['started_at' => now()]);
            }

            return $locked->refresh();
        });
    }
}
