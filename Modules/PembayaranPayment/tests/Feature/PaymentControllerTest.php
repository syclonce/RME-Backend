<?php

namespace Modules\PembayaranPayment\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranCashier\Models\Cashier;
use Modules\PembayaranCashierShift\Models\CashierShift;
use Modules\PembayaranInvoice\Models\Invoice;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    private int $shiftId;


    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }
    private function actingUser(): User
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $employee = Employee::factory()->create(['user_id' => $user->id]);
        $cashier = Cashier::factory()->create(['employee_id' => $employee->id]);
        $this->shiftId = CashierShift::factory()->create([
            'cashier_id' => $cashier->id, 'opened_by' => $user->id,
        ])->id;
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_payment_and_locks_invoice_when_fully_paid(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);

        $response = $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $this->shiftId,
            'payment_method' => 'cash',
            'amount' => 100000,
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('PAY-'.now()->format('Y').'-', $response->json('data.payment_number'));
        $this->assertTrue($invoice->fresh()->is_locked);
    }

    public function test_partial_payment_does_not_lock_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $this->shiftId,
            'payment_method' => 'cash',
            'amount' => 50000,
        ])->assertCreated();

        $this->assertFalse($invoice->fresh()->is_locked);
    }

    public function test_it_cannot_pay_an_already_locked_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->locked()->create();

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $this->shiftId,
            'payment_method' => 'cash',
            'amount' => 10000,
        ])->assertStatus(422);
    }

    public function test_it_rejects_payment_exceeding_outstanding_balance(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $this->shiftId,
            'payment_method' => 'cash',
            'amount' => 999999,
        ])->assertStatus(422);

        $this->assertDatabaseCount('payments', 0);
        $this->assertFalse($invoice->fresh()->is_locked);
    }

    public function test_double_submit_dengan_kunci_sama_tidak_ganda(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);
        $payload = [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $this->shiftId,
            'payment_method' => 'cash',
            'amount' => 40000,
            'idempotency_key' => 'kasir-1-'.uniqid(),
        ];

        $first = $this->postJson('/api/v1/payments', $payload)->assertCreated();
        $second = $this->postJson('/api/v1/payments', $payload)->assertOk();

        $this->assertSame($first->json('data.id'), $second->json('data.id'));
        $this->assertDatabaseCount('payments', 1);
    }

    public function test_it_rejects_payment_exceeding_remaining_balance_after_partial_payment(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $this->shiftId,
            'payment_method' => 'cash',
            'amount' => 60000,
        ])->assertCreated();

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $this->shiftId,
            'payment_method' => 'cash',
            'amount' => 60000,
        ])->assertStatus(422);

        $this->assertDatabaseCount('payments', 1);
    }

    public function test_it_records_who_received_the_payment(): void
    {
        $user = $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $this->shiftId,
            'payment_method' => 'cash',
            'amount' => 100000,
        ]);

        $this->assertDatabaseHas('payments', ['invoice_id' => $invoice->id, 'received_by' => $user->id]);
    }

    public function test_reversal_is_append_only_and_reopens_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 100000]);
        $paymentId = $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $this->shiftId,
            'payment_method' => 'cash', 'amount' => 100000,
        ])->assertCreated()->json('data.id');

        $this->postJson("/api/v1/payments/{$paymentId}/reverse", [
            'cashier_shift_id' => $this->shiftId,
            'reason' => 'Pembayaran tercatat dua kali',
        ])->assertCreated();

        $this->assertDatabaseHas('payments', ['id' => $paymentId, 'status' => 'reversed']);
        $this->assertDatabaseHas('payment_reversals', ['payment_id' => $paymentId]);
        $this->assertFalse($invoice->fresh()->is_locked);
        $this->assertSame('open', $invoice->fresh()->status);
        $this->postJson("/api/v1/payments/{$paymentId}/reverse", [
            'cashier_shift_id' => $this->shiftId, 'reason' => 'Ulang',
        ])->assertStatus(422);
    }
}
