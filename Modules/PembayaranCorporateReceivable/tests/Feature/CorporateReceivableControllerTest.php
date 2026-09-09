<?php

namespace Modules\PembayaranCorporateReceivable\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranCorporateReceivable\Models\CorporateReceivable;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Tests\TestCase;

class CorporateReceivableControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }
    private function actingUser(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');
    }

    public function test_it_lists_corporate_receivables(): void
    {
        $this->actingUser();
        CorporateReceivable::factory()->count(3)->create();

        $this->getJson('/api/v1/corporate-receivables')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_corporate_receivable_as_outstanding(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        $guarantor = Guarantor::factory()->create();

        $this->postJson('/api/v1/corporate-receivables', [
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'amount' => 1500000,
            'due_date' => now()->addDays(30)->toDateString(),
        ])->assertCreated()->assertJsonPath('data.status', 'outstanding');

        $this->assertDatabaseHas('corporate_receivables', ['invoice_id' => $invoice->id, 'guarantor_id' => $guarantor->id]);
    }

    public function test_status_cannot_be_injected_at_create(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        $guarantor = Guarantor::factory()->create();

        $this->postJson('/api/v1/corporate-receivables', [
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'amount' => 1500000,
            'due_date' => now()->addDays(30)->toDateString(),
            'status' => 'settled',
        ])->assertCreated()->assertJsonPath('data.status', 'outstanding');
    }

    public function test_it_updates_status_to_settled(): void
    {
        $this->actingUser();
        $receivable = CorporateReceivable::factory()->create(['status' => 'outstanding']);

        $this->patchJson("/api/v1/corporate-receivables/{$receivable->id}/transition", ['status' => 'settled'])
            ->assertOk()
            ->assertJsonPath('data.status', 'settled');
    }

    public function test_it_writes_off_an_outstanding_receivable(): void
    {
        $this->actingUser();
        $receivable = CorporateReceivable::factory()->create(['status' => 'outstanding']);

        $this->patchJson("/api/v1/corporate-receivables/{$receivable->id}/transition", ['status' => 'written_off'])
            ->assertOk()
            ->assertJsonPath('data.status', 'written_off');
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $receivable = CorporateReceivable::factory()->create();

        $this->patchJson("/api/v1/corporate-receivables/{$receivable->id}/transition", ['status' => 'invalid'])
            ->assertStatus(422);
    }

    public function test_it_rejects_transitioning_an_already_settled_receivable(): void
    {
        $this->actingUser();
        $receivable = CorporateReceivable::factory()->create(['status' => 'settled']);

        $this->patchJson("/api/v1/corporate-receivables/{$receivable->id}/transition", ['status' => 'written_off'])
            ->assertStatus(422);
    }

    public function test_it_rejects_creating_a_second_outstanding_receivable_for_the_same_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        $guarantor = Guarantor::factory()->create();

        CorporateReceivable::factory()->create([
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'status' => 'outstanding',
        ]);

        $this->postJson('/api/v1/corporate-receivables', [
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'amount' => 500000,
            'due_date' => now()->addDays(30)->toDateString(),
        ])->assertStatus(422);
    }

    public function test_it_allows_creating_a_new_receivable_after_previous_one_is_settled(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create();
        $guarantor = Guarantor::factory()->create();

        CorporateReceivable::factory()->create([
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'status' => 'settled',
        ]);

        $this->postJson('/api/v1/corporate-receivables', [
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'amount' => 500000,
            'due_date' => now()->addDays(30)->toDateString(),
        ])->assertCreated()->assertJsonPath('data.status', 'outstanding');
    }

    public function test_guest_cannot_access_corporate_receivables(): void
    {
        $this->getJson('/api/v1/corporate-receivables')->assertStatus(401);
    }
}
