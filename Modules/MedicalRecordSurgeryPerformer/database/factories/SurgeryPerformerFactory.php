<?php

namespace Modules\MedicalRecordSurgeryPerformer\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordSurgeryPerformer\Models\SurgeryPerformer;

class SurgeryPerformerFactory extends Factory
{
    protected $model = SurgeryPerformer::class;

    public function definition(): array
    {
        return [
            'surgery_id' => 1,
            'visit_id' => Visit::factory(),
            'doctor_id' => 1,
            'role' => 'Main Surgeon',
            'notes' => $this->faker->sentence(),
        ];
    }
}
