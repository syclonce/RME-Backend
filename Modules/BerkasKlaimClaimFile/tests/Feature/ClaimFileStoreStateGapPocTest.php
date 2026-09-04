<?php

namespace Modules\BerkasKlaimClaimFile\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\PembayaranInvoice\Services\InvoiceService;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

/**
 * POC: claim-file creation accepts terminal statuses, skipping the
 * forward-only transition machine enforced on update().
 */
class ClaimFileStoreStateGapPocTest extends TestCase
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

    public function test_store_forces_initial_draft_state(): void
    {
        $visit = $this->createVisitWithLockedBilling();

        $response = $this->postJson('/api/v1/claim-files', [
            'visit_id' => $visit->id,
            'status' => 'paid',
        ]);

        if ($response->status() === 201 && $response->json('status') === 'paid') {
            fwrite(STDERR, "[POC-B] claim minted directly in terminal status 'paid'\n");
            $this->fail('[POC-B] store() accepted terminal status paid, bypassing transition machine');
        }

        $response->assertCreated();
        $this->assertSame('draft', $response->json('status'));
        $this->assertDatabaseHas('claim_files', ['visit_id' => $visit->id, 'status' => ClaimFile::STATUS_DRAFT]);
        $this->assertNull($response->json('submitted_at'));
    }

    public function test_created_claim_still_transitions_forward_normally(): void
    {
        $visit = $this->createVisitWithLockedBilling();

        $created = $this->postJson('/api/v1/claim-files', ['visit_id' => $visit->id])
            ->assertCreated();

        $claimId = $created->json('id');

        $this->putJson("/api/v1/claim-files/{$claimId}", ['status' => 'submitted'])
            ->assertOk()
            ->assertJsonPath('status', 'submitted');
    }
}