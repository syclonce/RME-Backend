<?php

namespace Modules\MedicalRecordBreastExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordBreastExamination\Models\BreastExamination;

class BreastExaminationFactory extends Factory
{
    protected $model = BreastExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'side' => 'bilateral',
            'inspection' => 'Symmetrical, no skin changes',
            'palpation' => 'No masses palpated',
            'lump_present' => false,
            'nipple_discharge' => 'None',
            'findings' => 'Normal breast examination',
            'examined_at' => now(),
        ];
    }
}
