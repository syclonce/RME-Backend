<?php

namespace Modules\MedicalRecordToenailExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordToenailExamination\Models\ToenailExamination;

class ToenailExaminationFactory extends Factory
{
    protected $model = ToenailExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'color' => 'Pink',
            'capillary_refill_seconds' => 2,
            'clubbing' => false,
            'cyanosis' => false,
            'lesions' => null,
            'findings' => 'Normal toenail examination',
            'examined_at' => now(),
        ];
    }
}
