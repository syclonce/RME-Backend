<?php

namespace Modules\BerkasKlaimClaimFile\Tests\Feature;

use Tests\TestCase;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\PembayaranInvoice\Services\InvoiceService;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\Auth\Models\User;

class ClaimFileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');
    }

    /** Selesaikan RME -> finalisasi pelayanan -> kunci tagihan, prasyarat klaim. */
    private function createVisitWithLockedBilling(): Visit
    {
        $visit = Visit::factory()->create();
        ClinicalNote::factory()->create(['visit_id' => $visit->id]);
        Diagnosis::factory()->primary()->create(['visit_id' => $visit->id]);
        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/start")->assertCreated();
        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/finalize")->assertOk();
        $this->postJson("/api/v1/visits/{$visit->id}/finalize-service")->assertOk();

        $invoice = app(InvoiceService::class)->ensureForVisit($visit->id);
        app(InvoiceService::class)->lock($invoice->id);

        return $visit;
    }

    public function test_can_list_claim_files()
    {
        ClaimFile::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/claim-files');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_claim_file()
    {
        $visit = $this->createVisitWithLockedBilling();

        $response = $this->postJson('/api/v1/claim-files', [
            'visit_id' => $visit->id,
            'status' => 'draft'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('claim_files', ['visit_id' => $visit->id]);
    }

    public function test_cannot_create_claim_file_when_billing_is_not_locked()
    {
        $visit = Visit::factory()->create();

        $response = $this->postJson('/api/v1/claim-files', ['visit_id' => $visit->id]);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('claim_files', ['visit_id' => $visit->id]);
    }

    public function test_can_update_claim_file()
    {
        $file = ClaimFile::factory()->create(['status' => 'draft']);

        $response = $this->putJson("/api/v1/claim-files/{$file->id}", [
            'status' => 'submitted'
        ]);

        $response->assertStatus(200);
        $this->assertEquals('submitted', $file->fresh()->status);
    }

    public function test_cannot_revert_submitted_claim_back_to_draft()
    {
        $file = ClaimFile::factory()->create(['status' => 'draft']);
        $this->putJson("/api/v1/claim-files/{$file->id}", ['status' => 'submitted'])->assertOk();

        $this->putJson("/api/v1/claim-files/{$file->id}", ['status' => 'draft'])
            ->assertStatus(422);

        $this->assertEquals('submitted', $file->fresh()->status);
    }

    public function test_rejects_arbitrary_status_string()
    {
        $file = ClaimFile::factory()->create(['status' => 'draft']);

        $this->putJson("/api/v1/claim-files/{$file->id}", ['status' => 'totally-arbitrary-state'])
            ->assertStatus(422);
    }

    public function test_can_delete_claim_file()
    {
        $file = ClaimFile::factory()->create();

        $response = $this->deleteJson("/api/v1/claim-files/{$file->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('claim_files', ['id' => $file->id]);
    }
}
