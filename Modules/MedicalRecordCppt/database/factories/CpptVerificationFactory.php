<?php

namespace Modules\MedicalRecordCppt\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordCppt\Models\CpptVerification;
use Modules\PendaftaranVisit\Models\Visit;

class CpptVerificationFactory extends Factory
{
    protected $model = CpptVerification::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'valid_until' => now()->addDay()->toDateString(),
            'verified_at' => now(),
            'verified_by' => Employee::factory(),
            'status' => 'verified',
        ];
    }
}
