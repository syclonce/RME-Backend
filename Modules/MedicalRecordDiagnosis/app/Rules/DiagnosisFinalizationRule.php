<?php

namespace Modules\MedicalRecordDiagnosis\Rules;

use App\Modules\Contracts\EncounterFinalizationRule;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;

class DiagnosisFinalizationRule implements EncounterFinalizationRule
{
    public function violations(int $visitId): array
    {
        return Diagnosis::query()->where('visit_id', $visitId)->where('is_primary', true)->exists()
            ? [] : ['Diagnosis utama wajib tersedia sebelum finalisasi RME.'];
    }
}
