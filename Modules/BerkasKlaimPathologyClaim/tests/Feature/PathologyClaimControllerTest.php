<?php

namespace Modules\BerkasKlaimPathologyClaim\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimPathologyClaim\Models\PathologyClaim;
use Modules\LayananLabOrder\Models\LabOrder;
use Tests\TestCase;

class PathologyClaimControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }
    private function actingUser(): User
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_draft_claim(): void
    {
        $this->actingUser();
        $claimFile = ClaimFile::factory()->create();
        $order = LabOrder::factory()->create();

        $response = $this->postJson('/api/v1/pathology-claims', [
            'claim_file_id' => $claimFile->id,
            'order_id' => $order->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'draft');
        $this->assertDatabaseHas('pathology_claims', ['claim_file_id' => $claimFile->id, 'order_id' => $order->id]);
    }

    public function test_status_cannot_be_injected_at_create(): void
    {
        $this->actingUser();
        $claimFile = ClaimFile::factory()->create();

        $response = $this->postJson('/api/v1/pathology-claims', [
            'claim_file_id' => $claimFile->id,
            'status' => 'approved',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'draft');
    }

    public function test_it_lists_claims_filtered_by_claim_file(): void
    {
        $this->actingUser();
        $claimFile = ClaimFile::factory()->create();
        PathologyClaim::factory()->create(['claim_file_id' => $claimFile->id]);
        PathologyClaim::factory()->create();

        $response = $this->getJson("/api/v1/pathology-claims?claim_file_id={$claimFile->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_submits_a_draft_claim(): void
    {
        $this->actingUser();
        $claim = PathologyClaim::factory()->create(['status' => 'draft']);

        $this->patchJson("/api/v1/pathology-claims/{$claim->id}/transition", ['status' => 'submitted'])
            ->assertOk()
            ->assertJsonPath('data.status', 'submitted');

        $this->assertNotNull($claim->fresh()->submitted_at);
    }

    public function test_it_approves_a_submitted_claim(): void
    {
        $this->actingUser();
        $claim = PathologyClaim::factory()->create(['status' => 'submitted']);

        $this->patchJson("/api/v1/pathology-claims/{$claim->id}/transition", ['status' => 'approved'])
            ->assertOk()
            ->assertJsonPath('data.status', 'approved');
    }

    public function test_it_rejects_updating_an_approved_claim(): void
    {
        $this->actingUser();
        $claim = PathologyClaim::factory()->create(['status' => 'approved']);

        $this->patchJson("/api/v1/pathology-claims/{$claim->id}/transition", ['status' => 'submitted'])
            ->assertStatus(422);
    }

    public function test_it_rejects_skipping_submitted_straight_to_approved(): void
    {
        $this->actingUser();
        $claim = PathologyClaim::factory()->create(['status' => 'draft']);

        $this->patchJson("/api/v1/pathology-claims/{$claim->id}/transition", ['status' => 'approved'])
            ->assertStatus(422);
    }

    public function test_guest_cannot_access_pathology_claims(): void
    {
        $this->getJson('/api/v1/pathology-claims')->assertStatus(401);
    }
}
