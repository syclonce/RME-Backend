<?php

namespace Modules\PembayaranInvoiceSubsidy\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceSubsidy\Models\InvoiceSubsidy;
use Tests\TestCase;

class InvoiceSubsidyControllerTest extends TestCase
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

    public function test_it_creates_an_invoice_subsidy(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $response = $this->postJson('/api/v1/invoice-subsidies', [
            'invoice_id' => $invoice->id,
            'subsidy_source' => 'pemerintah_daerah',
            'subsidy_amount' => 500000,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
    }

    public function test_it_rejects_unknown_subsidy_source(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $this->postJson('/api/v1/invoice-subsidies', [
            'invoice_id' => $invoice->id,
            'subsidy_source' => 'not_a_valid_source',
            'subsidy_amount' => 500000,
        ])->assertStatus(422);
    }

    public function test_status_cannot_be_injected_at_create(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();

        $response = $this->postJson('/api/v1/invoice-subsidies', [
            'invoice_id' => $invoice->id,
            'subsidy_source' => 'pemerintah_daerah',
            'subsidy_amount' => 500000,
            'status' => 'approved',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
    }

    public function test_it_stamps_approver_when_approved(): void
    {
        $user = $this->actingUser();
        $subsidy = InvoiceSubsidy::factory()->create(['status' => 'pending']);

        $this->patchJson("/api/v1/invoice-subsidies/{$subsidy->id}/transition", ['status' => 'approved'])
            ->assertOk();

        $this->assertDatabaseHas('invoice_subsidies', [
            'id' => $subsidy->id,
            'status' => 'approved',
            'approved_by' => $user->id,
        ]);
    }

    public function test_it_rejects_a_pending_subsidy(): void
    {
        $this->actingUser();
        $subsidy = InvoiceSubsidy::factory()->create(['status' => 'pending']);

        $this->patchJson("/api/v1/invoice-subsidies/{$subsidy->id}/transition", ['status' => 'rejected'])
            ->assertOk()
            ->assertJsonPath('data.status', 'rejected');
    }

    public function test_it_rejects_transitioning_an_already_approved_subsidy(): void
    {
        $this->actingUser();
        $subsidy = InvoiceSubsidy::factory()->create(['status' => 'approved']);

        $this->patchJson("/api/v1/invoice-subsidies/{$subsidy->id}/transition", ['status' => 'rejected'])
            ->assertStatus(422);
    }

    public function test_it_deletes_an_invoice_subsidy(): void
    {
        $this->actingUser();
        $subsidy = InvoiceSubsidy::factory()->create();

        $this->deleteJson("/api/v1/invoice-subsidies/{$subsidy->id}")->assertStatus(204);
    }
}
