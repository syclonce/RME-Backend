<?php

namespace Modules\PembayaranInvoice\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranCashier\Models\Cashier;
use Modules\PembayaranCashierShift\Models\CashierShift;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPayment\Models\Payment;
use Tests\TestCase;

/**
 * Regression contracts for the billing engine (formerly vulnerable PoCs).
 *
 * Each case asserts the FIXED fail-closed behavior through the public HTTP
 * API as an authenticated petugas: deletion of a financially active invoice
 * and total-below-collected adjustments must be rejected.
 */
class InvoiceBizlogicInvariantPocTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }

    private function actingUser(): int
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $employee = Employee::factory()->create(['user_id' => $user->id]);
        $cashier = Cashier::factory()->create(['employee_id' => $employee->id]);
        $shift = CashierShift::factory()->create(['cashier_id' => $cashier->id, 'opened_by' => $user->id]);
        $this->actingAs($user, 'sanctum');

        return $shift->id;
    }

    /**
     * P1: DELETE /invoices/{id} on a partially-paid invoice is rejected and
     * every recorded payment row survives.
     */
    public function test_p1_delete_partially_paid_invoice_is_rejected_and_payments_survive(): void
    {
        $shiftId = $this->actingUser();

        $invoice = Invoice::factory()->create(['total_amount' => 100000]);

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $shiftId,
            'payment_method' => 'cash',
            'amount' => 60000,
        ])->assertCreated();

        $invoice->refresh();
        $this->assertFalse($invoice->is_locked, 'precondition: partially paid invoice stays unlocked');

        $this->deleteJson("/api/v1/invoices/{$invoice->id}")->assertStatus(422);

        $this->assertNotNull(Invoice::find($invoice->id), 'invoice row survives');
        $this->assertSame(1, Payment::query()->where('invoice_id', $invoice->id)->count(),
            'recorded cash payment survives');
    }

    /**
     * P4: PUT /invoices/{id} may not push total_amount below what has already
     * been collected; the update is rejected with payments untouched.
     */
    public function test_p4_rounding_adjustment_dropping_total_below_collected_is_rejected(): void
    {
        $shiftId = $this->actingUser();

        $invoice = Invoice::factory()->create([
            'total_amount' => 100000,
            'rounding_adjustment' => 0,
        ]);

        InvoiceItemStub::for($invoice, 100000);

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $shiftId,
            'payment_method' => 'cash',
            'amount' => 99500,
        ])->assertCreated();

        $response = $this->putJson("/api/v1/invoices/{$invoice->id}", [
            'rounding_adjustment' => -999,
            'invoice_number' => 'INV-MANUAL-0001',
        ]);

        $response->assertStatus(422);

        $invoice->refresh();
        $this->assertEquals('100000.00', (string) $invoice->subtotal, 'items unchanged');
        $this->assertEquals(0.0, (float) $invoice->rounding_adjustment,
            'rejected adjustment is not persisted');
        // The whole rejected payload is rolled back: neither the manual number
        // nor the adjustment was persisted.
        $this->assertNotSame('INV-MANUAL-0001', $invoice->invoice_number);
        $paid = (float) $invoice->payments()->sum('amount');
        $this->assertEquals(99500.0, $paid, 'collected payment unchanged');
        $this->assertFalse(
            $paid > (float) $invoice->total_amount,
            sprintf('invariant holds: collected %.2f never exceeds total %.2f on an open invoice', $paid, (float) $invoice->total_amount),
        );
    }
}
