<?php

namespace Modules\LayananLabOrder\Rules;

use App\Modules\Contracts\EncounterFinalizationRule;
use Modules\LayananLabOrder\Models\LabOrder;

class LabOrderFinalizationRule implements EncounterFinalizationRule
{
    public function violations(int $visitId): array
    {
        return LabOrder::query()->where('visit_id', $visitId)
            ->whereNotIn('status', ['completed', 'cancelled'])->exists()
            ? ['Masih ada order laboratorium yang belum terminal.'] : [];
    }
}
