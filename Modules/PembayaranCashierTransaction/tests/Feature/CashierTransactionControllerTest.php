<?php

namespace Modules\PembayaranCashierTransaction\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranCashierShift\Models\CashierShift;
use Modules\PembayaranCashier\Models\Cashier;
use Modules\PembayaranCashierTransaction\Models\CashierTransaction;
use Modules\PembayaranInvoice\Models\Invoice;
use Tests\TestCase;

class CashierTransactionControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }
    private function actingUser(): array
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $employee = Employee::factory()->create(['user_id' => $user->id]);
        $cashier = Cashier::factory()->create(['employee_id' => $employee->id]);
        $shift = CashierShift::factory()->create(['cashier_id' => $cashier->id, 'opened_by' => $user->id]);
        $this->actingAs($user, 'sanctum');

        return [$cashier, $shift];
    }

    public function test_it_lists_cashier_transactions(): void
    {
        $this->actingUser();
        CashierTransaction::factory()->count(3)->create();

        $this->getJson('/api/v1/cashier-transactions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_cashier_transaction(): void
    {
        [$cashier, $shift] = $this->actingUser();
        $invoice = Invoice::factory()->create();

        $this->postJson('/api/v1/cashier-transactions', [
            'cashier_id' => $cashier->id,
            'cashier_shift_id' => $shift->id,
            'invoice_id' => $invoice->id,
            'amount' => 150000,
            'transaction_type' => 'in',
        ])->assertCreated()->assertJsonPath('data.transaction_type', 'in');

        $this->assertDatabaseHas('cashier_transactions', ['cashier_id' => $cashier->id, 'invoice_id' => $invoice->id]);
    }

    public function test_it_rejects_invalid_transaction_type(): void
    {
        [$cashier, $shift] = $this->actingUser();
        $invoice = Invoice::factory()->create();

        $this->postJson('/api/v1/cashier-transactions', [
            'cashier_id' => $cashier->id,
            'cashier_shift_id' => $shift->id,
            'invoice_id' => $invoice->id,
            'amount' => 150000,
            'transaction_type' => 'transfer',
        ])->assertStatus(422);
    }

    public function test_it_shows_cashier_transaction(): void
    {
        $this->actingUser();
        $transaction = CashierTransaction::factory()->create();

        $this->getJson("/api/v1/cashier-transactions/{$transaction->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $transaction->id);
    }

    public function test_it_has_no_update_or_delete_routes(): void
    {
        $this->actingUser();
        $transaction = CashierTransaction::factory()->create();

        $this->putJson("/api/v1/cashier-transactions/{$transaction->id}", ['amount' => 1])->assertStatus(405);
        $this->deleteJson("/api/v1/cashier-transactions/{$transaction->id}")->assertStatus(405);
    }

    public function test_guest_cannot_access_cashier_transactions(): void
    {
        $this->getJson('/api/v1/cashier-transactions')->assertStatus(401);
    }
}
