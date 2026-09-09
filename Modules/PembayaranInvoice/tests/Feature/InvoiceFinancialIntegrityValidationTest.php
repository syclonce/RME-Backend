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
 * Independent validation of financial-integrity invariants on the invoice
 * lifecycle. Everything is driven through the public HTTP API as an
 * authenticated petugas -- no direct model writes for the actions under test.
 */
class InvoiceFinancialIntegrityValidationTest extends TestCase
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

    public function test_val_1_delete_partially_paid_invoice_destroys_payment_records(): void
    {
        $shiftId = $this->actingUser();

        // 1. Buka invoice untuk kunjungan baru lewat HTTP resmi.
        $created = $this->postJson('/api/v1/invoices', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->serviceFinalized()->create()->id,
        ])->assertCreated()->json('data.id');

        // 2. Posting satu item layanan 100000 lewat HTTP resmi.
        \Modules\PembayaranInvoiceItem\Models\InvoiceItem::create([
            'invoice_id' => $created,
            'description' => 'Tindakan validasi',
            'quantity' => 1,
            'unit_price' => 100000,
        ]);
        Invoice::findOrFail($created)->recalculateTotals();

        $invoice = Invoice::findOrFail($created);
        $this->assertSame('100000.00', (string) $invoice->total_amount);

        // 3. Kasir menerima uang tunai sebagian: 60000 dari 100000.
        $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $shiftId,
            'payment_method' => 'cash',
            'amount' => 60000,
        ])->assertCreated();

        $invoice->refresh();
        $this->assertFalse($invoice->is_locked, 'precondition: partially-paid invoice remains unlocked/open');
        $this->assertSame(1, Payment::query()->where('invoice_id', $invoice->id)->count());

        // 4. Petugas mencoba menghapus invoice yang masih punya pembayaran
        //    terkumpul -- harus ditolak (sebelum perbaikan: 204 dan seluruh
        //    baris pembayaran ikut ter-hapus lewat cascade FK).
        $deleteResponse = $this->deleteJson("/api/v1/invoices/{$invoice->id}");

        $deleteResponse->assertStatus(422);

        // Tidak ada kerusakan catatan keuangan: invoice DAN pembayaran utuh.
        $invoice->refresh();
        $this->assertNotNull(Invoice::find($invoice->id));
        $this->assertSame(1, Payment::query()->where('invoice_id', $invoice->id)->count());
        $this->assertSame('60000.00', number_format((float) $invoice->payments()->sum("amount"), 2, ".", ""));

    }

    public function test_val_2_rounding_adjustment_pushes_total_below_collected_payments(): void
    {
        $shiftId = $this->actingUser();

        $created = $this->postJson('/api/v1/invoices', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->serviceFinalized()->create()->id,
        ])->assertCreated()->json('data.id');

        \Modules\PembayaranInvoiceItem\Models\InvoiceItem::create([
            'invoice_id' => $created,
            'cashier_shift_id' => $shiftId,
            'description' => 'Tindakan validasi',
            'quantity' => 1,
            'unit_price' => 100000,
        ]);
        Invoice::findOrFail($created)->recalculateTotals();

        $this->postJson('/api/v1/payments', [
            'invoice_id' => $created,
            'cashier_shift_id' => $shiftId,
            'payment_method' => 'cash',
            'amount' => 99500,
        ])->assertCreated();

        // Update yang menekan total di bawah uang terkumpul harus ditolak
        // (sebelum perbaikan: 200, total jadi 99001 < collected 99500).
        $this->putJson("/api/v1/invoices/{$created}", [
            'rounding_adjustment' => -999,
        ])->assertStatus(422);

        // Nilai lama tetap utuh.
        $invoice = Invoice::findOrFail($created);
        $this->assertEquals(0.0, (float) $invoice->rounding_adjustment);
        $this->assertEquals('100000.00', (string) $invoice->total_amount);
        $this->assertSame('99500.00', number_format((float) $invoice->payments()->sum("amount"), 2, ".", ""));
        $this->assertSame('open', $invoice->status);

        // Koreksi pembulatan yang sah (tidak menembus batas pembayaran) tetap boleh.
        $this->putJson("/api/v1/invoices/{$invoice->id}", ['rounding_adjustment' => -500])
            ->assertOk();
        $this->assertEquals('99500.00', (string) $invoice->fresh()->total_amount,
            'legitimate rounding down to exactly the collected amount is still allowed');

        // Konsekuensi hilir: kasir tidak bisa memposting apa pun lagi padahal
        // status masih terbuka -- sisa tagihan jadi negatif (-499).
        $second = $this->postJson('/api/v1/payments', [
            'invoice_id' => $invoice->id,
            'cashier_shift_id' => $shiftId,
            'payment_method' => 'cash',
            'amount' => 0.01,
        ]);

        $second->assertStatus(422);
        $invoice->refresh();
        $this->assertSame('open', $invoice->status, 'invoice stays open although patient overpaid');
        $this->assertFalse($invoice->is_locked, 'no lock/refund gate ever fires on over-collection');
    }

    public function test_val_3_invoice_number_editable_on_financially_active_open_invoice(): void
    {
        $shiftId = $this->actingUser();

        $created = $this->postJson('/api/v1/invoices', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->serviceFinalized()->create()->id,
        ])->assertCreated()->json('data.id');

        $originalNumber = Invoice::findOrFail($created)->invoice_number;

        // Buat tagihan bernilai lewat item layanan (model-level; jalur HTTP
        // untuk harga satuan kini dibatasi admin oleh perbaikan terpisah).
        \Modules\PembayaranInvoiceItem\Models\InvoiceItem::create([
            'invoice_id' => $created,
            'cashier_shift_id' => $shiftId,
            'description' => 'Tindakan validasi',
            'quantity' => 1,
            'unit_price' => 100000,
        ]);
        Invoice::findOrFail($created)->recalculateTotals();

        // Tagihan dengan uang terkumpul (aktif secara finansial).
        $this->postJson('/api/v1/payments', [
            'invoice_id' => $created,
            'cashier_shift_id' => $shiftId,
            'payment_method' => 'cash',
            'amount' => 1,
        ])->assertCreated();

        // VULNERABLE BEHAVIOR EXPECTATION (pre-fix): nomor tagihan pada
        // dokumen finansial aktif bisa ditimpa bebas lewat PUT biasa.
        $response = $this->putJson("/api/v1/invoices/{$created}", [
            'invoice_number' => 'INV-FORGED-0001',
        ]);

        $response->assertOk();

        $freshNumber = Invoice::findOrFail($created)->invoice_number;
        $this->assertSame('INV-FORGED-0001', $freshNumber);
        $this->assertNotSame($originalNumber, $freshNumber);
    }
}
