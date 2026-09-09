<?php

namespace Modules\LayananMedicalSupplyUsage\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananMedicalSupplyUsage\Models\MedicalSupplyUsage;

class MedicalSupplyUsageService
{
    private const TRANSITIONS = [
        'draft' => ['posted'],
        'posted' => [],
    ];

    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
    ) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): MedicalSupplyUsage
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => MedicalSupplyUsage::create([
            ...Arr::except($data, 'status'),
            'status' => 'draft',
        ]));
    }

    public function transition(MedicalSupplyUsage $usage, string $target, User $user): MedicalSupplyUsage
    {
        $this->medicalRecordGate->assertWritable((int) $usage->visit_id, $user);
        $allowed = self::TRANSITIONS[$usage->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi pemakaian BHP {$usage->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($usage, $target) {
            $locked = MedicalSupplyUsage::query()->whereKey($usage->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status pemakaian BHP sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
