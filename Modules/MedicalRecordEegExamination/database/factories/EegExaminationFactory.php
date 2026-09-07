<?php

namespace Modules\MedicalRecordEegExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEegExamination\Models\EegExamination;

class EegExaminationFactory extends Factory
{
    protected $model = EegExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'patient_id' => 1,
            'background_rhythm' => 'Alpha 9-10 Hz',
            'epileptiform_discharges' => false,
            'abnormality_type' => null,
            'clinical_correlation' => 'Normal EEG study',
            'conclusion' => 'Normal adult wakefulness EEG',
            'examined_at' => now(),
        ];
    }
}
