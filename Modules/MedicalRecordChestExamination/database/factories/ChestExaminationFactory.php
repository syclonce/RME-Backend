<?php

namespace Modules\MedicalRecordChestExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordChestExamination\Models\ChestExamination;

class ChestExaminationFactory extends Factory
{
    protected $model = ChestExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'inspection' => 'Symmetrical chest expansion',
            'palpation' => 'Normal tactile fremitus',
            'percussion' => 'Resonant',
            'auscultation_breath_sounds' => 'Vesicular',
            'auscultation_heart_sounds' => 'S1 S2 Normal',
            'findings' => 'Normal chest examination',
            'examined_at' => now(),
        ];
    }
}
