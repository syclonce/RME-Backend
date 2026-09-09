<?php

namespace Modules\LayananMedicationIteration\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\LayananMedicationIteration\Models\MedicationIteration;

/**
 * State machine iterasi obat: pending -> dispensed saja. Sekali dispensed,
 * final (iterasi berikutnya adalah baris baru, bukan transisi balik).
 */
class MedicationIterationService
{
    private const TRANSITIONS = [
        'pending' => ['dispensed'],
        'dispensed' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): MedicationIteration
    {
        return DB::transaction(fn () => MedicationIteration::create([
            ...Arr::except($data, 'status'),
            'status' => 'pending',
        ]));
    }

    public function transition(MedicationIteration $iteration, string $target): MedicationIteration
    {
        $allowed = self::TRANSITIONS[$iteration->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi iterasi obat {$iteration->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($iteration, $target) {
            $locked = MedicationIteration::query()->whereKey($iteration->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status iterasi obat sudah berubah.');

            if ($target === 'dispensed') {
                $locked->update(['status' => 'dispensed', 'dispensed_at' => $locked->dispensed_at ?? now()]);
            } else {
                $locked->update(['status' => $target]);
            }

            return $locked->refresh();
        });
    }
}
