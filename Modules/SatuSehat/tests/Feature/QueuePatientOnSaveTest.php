<?php

namespace Modules\SatuSehat\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\GeneralPatient\Models\Patient;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Tests\TestCase;

class QueuePatientOnSaveTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_patient_enqueues_patient_submission(): void
    {
        $patient = Patient::factory()->create();

        $this->assertDatabaseHas('satu_sehat_staging_submissions', [
            'resource_type' => 'Patient',
            'source_type' => Patient::class,
            'source_id' => $patient->id,
            'status' => 'pending',
        ]);
    }

    public function test_updating_patient_does_not_duplicate_submission(): void
    {
        $patient = Patient::factory()->create(['name' => 'Awal']);

        $patient->update(['name' => 'Diperbarui']);
        $patient->update(['name' => 'Diperbarui Lagi']);

        $this->assertSame(1, SatuSehatStagingSubmission::query()
            ->where('source_type', Patient::class)
            ->where('source_id', $patient->id)
            ->count());
    }

    public function test_update_refreshes_payload_to_latest_state(): void
    {
        $patient = Patient::factory()->create(['name' => 'Awal']);

        $patient->update(['name' => 'Diperbarui']);

        $submission = SatuSehatStagingSubmission::query()
            ->where('source_type', Patient::class)
            ->where('source_id', $patient->id)
            ->firstOrFail();

        $this->assertSame('Diperbarui', $submission->payload['name']);
    }
}
