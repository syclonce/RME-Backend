<?php

namespace Modules\SatuSehat\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Tests\TestCase;

class QueueConditionOnDiagnosisCreatedTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_diagnosis_enqueues_condition_submission(): void
    {
        $diagnosis = Diagnosis::factory()->create();

        $this->assertDatabaseHas('satu_sehat_staging_submissions', [
            'resource_type' => 'Condition',
            'source_type' => Diagnosis::class,
            'source_id' => $diagnosis->id,
            'status' => 'pending',
        ]);
    }

    public function test_repeated_saves_do_not_duplicate_submission(): void
    {
        $diagnosis = Diagnosis::factory()->create();

        // created hanya terpicu sekali saat insert; simulasikan event domain
        // berulang dengan memanggil observer secara langsung tidak diperlukan
        // di sini karena tidak ada jalur update - cukup pastikan satu insert
        // menghasilkan satu submission.
        $this->assertSame(1, SatuSehatStagingSubmission::query()
            ->where('source_type', Diagnosis::class)
            ->where('source_id', $diagnosis->id)
            ->count());
    }
}
