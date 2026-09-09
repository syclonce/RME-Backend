<?php

namespace Modules\MedicalRecordMchatAssessmentExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordMchatAssessmentExamination\Models\MchatAssessmentExamination;

class MchatAssessmentExaminationFactory extends Factory
{
    protected $model = MchatAssessmentExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'patient_id' => 1,
            'total_score' => 1,
            'risk_level' => 'Low Risk',
            'responses_json' => ['q1' => 'yes', 'q2' => 'no'],
            'recommendation' => 'Routine follow-up',
            'assessed_at' => now(),
        ];
    }
}
