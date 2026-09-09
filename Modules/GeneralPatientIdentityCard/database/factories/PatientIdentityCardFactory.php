<?php

namespace Modules\GeneralPatientIdentityCard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralIdentityCardType\Models\IdentityCardType;
use Modules\GeneralPatient\Models\Patient;

class PatientIdentityCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralPatientIdentityCard\Models\PatientIdentityCard::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'identity_card_type_id' => IdentityCardType::factory(),
            'identity_number' => fake()->unique()->numerify('1################'),
            'address' => null,
            'rt' => null,
            'rw' => null,
            'postal_code' => null,
            'village_id' => null,
            'is_same_as_current_address' => true,
            'is_active' => fake()->boolean(90),
        ];
    }
}
