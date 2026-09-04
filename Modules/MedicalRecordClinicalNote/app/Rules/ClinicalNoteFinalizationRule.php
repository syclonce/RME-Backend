<?php

namespace Modules\MedicalRecordClinicalNote\Rules;

use App\Modules\Contracts\EncounterFinalizationRule;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;

class ClinicalNoteFinalizationRule implements EncounterFinalizationRule
{
    public function violations(int $visitId): array
    {
        return ClinicalNote::query()->where('visit_id', $visitId)->exists()
            ? [] : ['Minimal satu catatan klinis wajib tersedia sebelum finalisasi RME.'];
    }
}
