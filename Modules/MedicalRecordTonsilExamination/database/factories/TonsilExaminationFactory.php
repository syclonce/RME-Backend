<?php

namespace Modules\MedicalRecordTonsilExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordTonsilExamination\Models\TonsilExamination;

class TonsilExaminationFactory extends Factory
{
    protected $model = TonsilExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'side' => 'bilateral',
            'grade' => 1,
            'color' => 'Pink',
            'exudate' => false,
            'findings' => 'Normal tonsil examination',
            'examined_at' => now(),
        ];
    }
}
