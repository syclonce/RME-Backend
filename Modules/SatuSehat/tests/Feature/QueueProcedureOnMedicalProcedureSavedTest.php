<?php

namespace Modules\SatuSehat\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Tests\TestCase;

class QueueProcedureOnMedicalProcedureSavedTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_medical_procedure_enqueues_procedure_submission(): void
    {
        $medicalProcedure = MedicalProcedure::factory()->create();

        $this->assertDatabaseHas('satu_sehat_staging_submissions', [
            'resource_type' => 'Procedure',
            'source_type' => MedicalProcedure::class,
            'source_id' => $medicalProcedure->id,
            'status' => 'pending',
        ]);
    }

    public function test_updating_medical_procedure_does_not_duplicate_submission(): void
    {
        $medicalProcedure = MedicalProcedure::factory()->create(['status' => 'completed']);

        $medicalProcedure->update(['status' => 'cancelled']);
        $medicalProcedure->update(['status' => 'completed']);

        $this->assertSame(1, SatuSehatStagingSubmission::query()
            ->where('source_type', MedicalProcedure::class)
            ->where('source_id', $medicalProcedure->id)
            ->count());
    }

    public function test_update_refreshes_payload_to_latest_status(): void
    {
        $medicalProcedure = MedicalProcedure::factory()->create(['status' => 'completed']);

        $medicalProcedure->update(['status' => 'cancelled']);

        $submission = SatuSehatStagingSubmission::query()
            ->where('source_type', MedicalProcedure::class)
            ->where('source_id', $medicalProcedure->id)
            ->firstOrFail();

        $this->assertSame('cancelled', $submission->payload['status']);
    }
}
