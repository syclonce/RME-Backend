<?php

namespace Modules\PendaftaranServiceHandover\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\PendaftaranServiceHandover\Models\ServiceHandover;

/**
 * Serah terima pelayanan: pending -> received/rejected saja. Sekali diterima
 * atau ditolak, tidak bisa diproses ulang (forward-only, sama seperti
 * InventoryStockRequest fulfill/reject).
 */
class ServiceHandoverService
{
    private const TRANSITIONS = [
        'pending' => ['received', 'rejected'],
        'received' => [],
        'rejected' => [],
    ];

    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
    ) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): ServiceHandover
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => ServiceHandover::create([
            ...Arr::except($data, 'status'),
            'handed_over_at' => $data['handed_over_at'] ?? now(),
            'handed_over_by' => $user->id,
            'status' => 'pending',
        ]));
    }

    /** @param array<string, mixed> $data */
    public function transition(ServiceHandover $handover, array $data, User $user): ServiceHandover
    {
        $this->medicalRecordGate->assertWritable((int) $handover->visit_id, $user);

        $target = $data['status'];
        $allowed = self::TRANSITIONS[$handover->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi serah terima {$handover->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($handover, $target, $data) {
            $locked = ServiceHandover::query()->whereKey($handover->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Serah terima ini sudah diproses.');

            if ($target === 'received') {
                $locked->update([
                    'status' => 'received',
                    'received_by' => $data['received_by'],
                    'received_at' => now(),
                    'notes' => $data['notes'] ?? $locked->notes,
                ]);
            } else {
                $locked->update([
                    'status' => 'rejected',
                    'notes' => $data['notes'] ?? $locked->notes,
                ]);
            }

            return $locked->refresh();
        });
    }
}
