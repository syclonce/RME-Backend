<?php

namespace Modules\MedicalRecordCppt\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordCppt\Models\CpptEntry;
use Modules\PendaftaranVisit\Models\Visit;

class CpptEntryFactory extends Factory
{
    protected $model = CpptEntry::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'recorded_at' => now(),
            'subjective' => fake()->sentence(),
            'objective' => fake()->sentence(),
            'assessment' => fake()->sentence(),
            'plan' => fake()->sentence(),
            'instruction' => fake()->sentence(),
            'profession' => fake()->randomElement(['dokter', 'perawat', 'bidan', 'apoteker']),
            'recorded_by' => Employee::factory(),
        ];
    }
}
