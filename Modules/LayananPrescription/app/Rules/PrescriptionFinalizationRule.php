<?php

namespace Modules\LayananPrescription\Rules;

use App\Modules\Contracts\EncounterFinalizationRule;
use Modules\LayananPrescription\Models\Prescription;

class PrescriptionFinalizationRule implements EncounterFinalizationRule
{
    public function violations(int $visitId): array
    {
        return Prescription::query()->where('visit_id', $visitId)
            ->whereNotIn('status', ['dispensed', 'cancelled'])->exists()
            ? ['Masih ada resep yang belum selesai atau dibatalkan.'] : [];
    }
}
