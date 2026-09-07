<?php

namespace Modules\MedicalRecordFingernailExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFingernailExamination\Models\FingernailExamination;

class FingernailExaminationFactory extends Factory
{
    protected $model = FingernailExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'color' => 'Pink',
            'capillary_refill_seconds' => 2,
            'clubbing' => false,
            'cyanosis' => false,
            'lesions' => null,
            'findings' => 'Normal fingernail examination',
            'examined_at' => now(),
        ];
    }
}
