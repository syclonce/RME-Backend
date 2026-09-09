<?php

namespace Modules\PembayaranCashierShift\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranCashier\Models\Cashier;
use Modules\PembayaranInvoice\Models\Invoice;
use Tests\TestCase;

class CashierShiftWorkflowTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Cashier $cashier;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
        $this->user = User::factory()->create();
        $this->user->assignRole('petugas');
        $employee = Employee::factory()->create(['user_id' => $this->user->id]);
        $this->cashier = Cashier::factory()->create(['employee_id' => $employee->id]);
        $this->actingAs($this->user, 'sanctum');
    }

    public function test_open_payment_and_close_reconciles_cash(): void
    {
        $shift = $this->postJson("/api/v1/cashiers/{$this->cashier->id}/shifts/open", ['initial_cash' => 500000])
            ->assertCreated()->assertJsonPath('data.status', 'open')->json('data');
        $this->postJson("/api/v1/cashiers/{$this->cashier->id}/shifts/open", ['initial_cash' => 0])->assertStatus(422);

        $invoice = Invoice::factory()->create(['total_amount' => 100000]);
        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $shift['id'],
            'payment_method' => 'cash',
            'amount' => 100000,
        ])->assertCreated();

        $this->postJson("/api/v1/cashier-shifts/{$shift['id']}/close", ['actual_cash' => 590000])
            ->assertOk()
            ->assertJsonPath('data.status', 'closed')
            ->assertJsonPath('data.expected_cash', '600000.00')
            ->assertJsonPath('data.cash_variance', '-10000.00');

        $this->postJson('/api/v1/payments', [
            'invoice_id' => Invoice::factory()->create(['total_amount' => 10000])->id,
            'cashier_shift_id' => $shift['id'],
            'payment_method' => 'cash', 'amount' => 10000,
        ])->assertStatus(422);
    }

    public function test_other_operator_cannot_use_cashier_shift(): void
    {
        $shiftId = $this->postJson("/api/v1/cashiers/{$this->cashier->id}/shifts/open", ['initial_cash' => 0])->json('data.id');
        $other = User::factory()->create();
        $other->assignRole('petugas');
        $this->actingAs($other, 'sanctum');

        $this->postJson("/api/v1/cashier-shifts/{$shiftId}/close", ['actual_cash' => 0])->assertForbidden();
    }
}
