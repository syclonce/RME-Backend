<?php

namespace Modules\LayananRadiologyOrder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;

class RadiologyOrderFactory extends Factory
{
    protected $model = RadiologyOrder::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'ordering_doctor_id' => \Modules\GeneralEmployee\Models\Employee::factory(),
            // Diserap dari ImagingOrderFactory: modality/body_part nullable di
            // kolom, tapi diisi default di factory supaya tes yang butuh nilai
            // ini tidak perlu override manual setiap kali.
            'modality' => fake()->randomElement(\Modules\LayananRadiologyOrder\Models\RadiologyOrder::MODALITIES),
            'body_part' => fake()->words(2, true),
            'ordered_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'scheduled_at' => null,
            'clinical_notes' => fake()->paragraph(),
            // Selalu 'pending': order baru memang selalu lahir pending
            // (RadiologyOrderService::create memaksanya), dan status acak membuat
            // tes yang memakai factory ini goyah — order 'completed'/'cancelled'
            // ditolak gerbang penulisan hasil. Pakai state() bila butuh status lain.
            'status' => 'pending',
        ];
    }

    /** Order yang sudah dijadwalkan (diserap dari ImagingOrderFactory::scheduled()). */
    public function scheduled(): static
    {
        return $this->state(fn () => [
            'status' => 'scheduled',
            'scheduled_at' => fake()->dateTimeBetween('now', '+1 week')->format('Y-m-d H:i:s'),
        ]);
    }

    /** Order yang sudah selesai — dipakai tes gerbang penulisan hasil. */
    public function completed(): static
    {
        return $this->state(fn () => ['status' => 'completed']);
    }

    /** Order yang dibatalkan. */
    public function cancelled(): static
    {
        return $this->state(fn () => ['status' => 'cancelled']);
    }
}
