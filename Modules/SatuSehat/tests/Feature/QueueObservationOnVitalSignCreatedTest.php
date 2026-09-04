<?php

namespace Modules\SatuSehat\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\MedicalRecordVitalSign\Models\VitalSign;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Tests\TestCase;

class QueueObservationOnVitalSignCreatedTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_vital_sign_enqueues_observation_submission(): void
    {
        $vitalSign = VitalSign::factory()->create();

        $this->assertDatabaseHas('satu_sehat_staging_submissions', [
            'resource_type' => 'Observation',
            'source_type' => VitalSign::class,
            'source_id' => $vitalSign->id,
            'status' => 'pending',
        ]);
    }

    public function test_each_vital_sign_record_enqueues_its_own_submission(): void
    {
        $vitalSignOne = VitalSign::factory()->create();
        $vitalSignTwo = VitalSign::factory()->create();

        $this->assertSame(1, SatuSehatStagingSubmission::query()
            ->where('source_type', VitalSign::class)
            ->where('source_id', $vitalSignOne->id)
            ->count());

        $this->assertSame(1, SatuSehatStagingSubmission::query()
            ->where('source_type', VitalSign::class)
            ->where('source_id', $vitalSignTwo->id)
            ->count());
    }
}
