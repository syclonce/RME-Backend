<?php

namespace Modules\PembayaranClaimInvoice\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;
use Modules\PembayaranInvoice\Models\Invoice;
use Tests\TestCase;

class ClaimInvoiceControllerTest extends TestCase
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

    public function test_it_creates_claim_invoice_with_auto_generated_number(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $response = $this->postJson('/api/v1/claim-invoices', [
            'invoice_id' => $invoice->id,
            'claim_amount' => 2500000,
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('CLM-'.now()->format('Y').'-', $response->json('data.claim_number'));
    }

    public function test_it_stamps_submission_time_when_marked_submitted(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create(['status' => 'draft']);

        $this->patchJson("/api/v1/claim-invoices/{$claim->id}/transition", ['status' => 'submitted'])
            ->assertOk()
            ->assertJsonPath('data.status', 'submitted');

        $this->assertNotNull($claim->fresh()->submitted_at);
    }

    public function test_status_cannot_be_injected_at_create(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $response = $this->postJson('/api/v1/claim-invoices', [
            'invoice_id' => $invoice->id,
            'claim_amount' => 1000000,
            'status' => 'paid',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'draft');
    }

    public function test_it_verifies_a_submitted_claim(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create(['status' => 'submitted']);

        $this->patchJson("/api/v1/claim-invoices/{$claim->id}/transition", [
            'status' => 'verified',
            'verified_amount' => 900000,
        ])->assertOk()->assertJsonPath('data.status', 'verified');

        $this->assertSame('900000.00', (string) $claim->fresh()->verified_amount);
    }

    public function test_it_pays_a_verified_claim(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create(['status' => 'verified']);

        $this->patchJson("/api/v1/claim-invoices/{$claim->id}/transition", ['status' => 'paid'])
            ->assertOk()
            ->assertJsonPath('data.status', 'paid');
    }

    public function test_it_rejects_a_submitted_claim_with_reason(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create(['status' => 'submitted']);

        $this->patchJson("/api/v1/claim-invoices/{$claim->id}/transition", [
            'status' => 'rejected',
            'rejection_reason' => 'Berkas tidak lengkap',
        ])->assertOk()->assertJsonPath('data.status', 'rejected');
    }

    public function test_it_rejects_a_rejection_without_reason(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create(['status' => 'submitted']);

        $this->patchJson("/api/v1/claim-invoices/{$claim->id}/transition", ['status' => 'rejected'])
            ->assertStatus(422);
    }

    public function test_it_rejects_skipping_submitted_straight_to_paid(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create(['status' => 'draft']);

        $this->patchJson("/api/v1/claim-invoices/{$claim->id}/transition", ['status' => 'paid'])
            ->assertStatus(422);
    }

    public function test_it_rejects_transition_on_a_paid_claim(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create(['status' => 'paid']);

        $this->patchJson("/api/v1/claim-invoices/{$claim->id}/transition", ['status' => 'verified'])
            ->assertStatus(422);
    }

    public function test_it_deletes_a_claim_invoice(): void
    {
        $this->actingUser();
        $claim = ClaimInvoice::factory()->create();

        $this->deleteJson("/api/v1/claim-invoices/{$claim->id}")->assertStatus(204);
    }

    public function test_guest_cannot_access_claim_invoices(): void
    {
        $this->getJson('/api/v1/claim-invoices')->assertStatus(401);
    }
}
