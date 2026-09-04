<?php

namespace Modules\LayananRadiologyOrder\Rules;

use App\Modules\Contracts\EncounterFinalizationRule;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;

/**
 * Meniru LabOrderFinalizationRule: episode RME tidak boleh difinalisasi
 * selama masih ada order radiologi yang belum berstatus terminal
 * (completed/cancelled) — hasil radiologi yang masih ditunggu.
 */
class RadiologyOrderFinalizationRule implements EncounterFinalizationRule
{
    public function violations(int $visitId): array
    {
        return RadiologyOrder::query()->where('visit_id', $visitId)
            ->whereNotIn('status', ['completed', 'cancelled'])->exists()
            ? ['Masih ada order radiologi yang belum terminal.'] : [];
    }
}
