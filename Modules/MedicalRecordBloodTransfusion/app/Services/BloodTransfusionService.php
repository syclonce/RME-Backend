<?php

namespace Modules\MedicalRecordBloodTransfusion\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;

/**
 * State machine transfusi darah — meniru pola LabOrderService/RadiologyOrderService
 * (Modules/LayananLabOrder, Modules/LayananRadiologyOrder): TRANSITIONS map,
 * lockForUpdate + cek status ganda (sebelum & sesudah lock), gerbang RME lewat
 * MedicalRecordGate.
 *
 * Sebelumnya BloodTransfusionController menulis status langsung lewat update()
 * tanpa gerbang apapun — transfusi bisa dicatat pada kunjungan yang RME-nya
 * sudah final, dan status bisa dipaksa lompat (mis. in_progress -> cancelled
 * setelah completed). Service ini menutup keduanya.
 */
class BloodTransfusionService
{
    private const TRANSITIONS = [
        'in_progress' => ['completed', 'stopped_reaction', 'cancelled'],
        'completed' => [],
        'stopped_reaction' => [],
        'cancelled' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): BloodTransfusion
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => BloodTransfusion::create([
            ...Arr::except($data, 'status'),
            'started_at' => $data['started_at'] ?? now(),
            'status' => 'in_progress',
            'created_by' => $user->id,
        ]));
    }

    public function transition(BloodTransfusion $transfusion, string $target, User $user, array $extra = []): BloodTransfusion
    {
        $this->medicalRecordGate->assertWritable((int) $transfusion->visit_id, $user);
        $allowed = self::TRANSITIONS[$transfusion->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi transfusi {$transfusion->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($transfusion, $target, $extra) {
            $locked = BloodTransfusion::query()->whereKey($transfusion->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status transfusi sudah berubah.');
            $locked->update([
                ...Arr::only($extra, ['ended_at', 'reaction_notes']),
                'status' => $target,
            ]);

            return $locked->refresh();
        });
    }
}
