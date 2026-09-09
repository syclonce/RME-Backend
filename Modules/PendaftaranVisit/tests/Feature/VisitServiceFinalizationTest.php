<?php

namespace Modules\PendaftaranVisit\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class VisitServiceFinalizationTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
        $this->user = User::factory()->create();
        $this->user->assignRole('petugas');
        $this->actingAs($this->user, 'sanctum');
    }

    public function test_service_cannot_finalize_before_medical_record(): void
    {
        $visit = Visit::factory()->create();
        $this->postJson("/api/v1/visits/{$visit->id}/finalize-service")->assertStatus(422);
    }

    public function test_final_medical_record_unlocks_service_finalization(): void
    {
        $visit = Visit::factory()->create();
        ClinicalNote::factory()->create(['visit_id' => $visit->id]);
        Diagnosis::factory()->primary()->create(['visit_id' => $visit->id]);

        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/start")->assertCreated();
        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/finalize")->assertOk();
        $this->postJson("/api/v1/visits/{$visit->id}/finalize-service")
            ->assertOk()->assertJsonPath('data.service_finalized_by', $this->user->id);
    }
}
