<?php

namespace Modules\PembayaranClaimInvoice\Tests\Feature;

use App\Events\InvoiceLocked;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Tests\TestCase;

/**
 * Listener CreateClaimInvoiceOnLock: menutup rantai tagihan -> klaim.
 * Sebelum ini, tagihan bisa dikunci/dibayar tanpa menghasilkan klaim apa pun
 * (audit: NOL rujukan silang PembayaranClaimInvoice <-> EKlaim).
 */
class CreateClaimInvoiceOnLockTest extends TestCase
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

    public function test_invoice_locked_dengan_penjamin_bpjs_membuat_claim_invoice_draft(): void
    {
        $invoice = Invoice::factory()->create([
            'total_amount' => 500000,
            'status' => 'open',
            'is_locked' => true,
        ]);

        $guarantor = Guarantor::factory()->bpjs()->create();

        $attachment = InvoiceGuarantor::factory()->create([
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'covered_amount' => 400000,
        ]);

        InvoiceLocked::dispatch($invoice);

        $this->assertDatabaseCount('claim_invoices', 1);

        $claim = ClaimInvoice::query()->where('invoice_id', $invoice->id)->firstOrFail();

        $this->assertSame('draft', $claim->status);
        $this->assertSame($guarantor->id, $claim->guarantor_id);
        $this->assertSame('400000.00', (string) $claim->claim_amount);
        $this->assertNotNull($claim->claim_number);
    }

    public function test_invoice_locked_pasien_umum_tidak_membuat_claim(): void
    {
        $invoice = Invoice::factory()->create([
            'total_amount' => 250000,
            'status' => 'paid',
            'is_locked' => true,
        ]);

        // Penjamin self_pay eksplisit (pasien bayar sendiri) — tidak boleh
        // menghasilkan klaim sama sekali.
        $guarantor = Guarantor::factory()->create(['payer_type' => 'self_pay']);

        InvoiceGuarantor::factory()->create([
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'covered_amount' => 0,
        ]);

        InvoiceLocked::dispatch($invoice);

        $this->assertDatabaseCount('claim_invoices', 0);
    }

    public function test_invoice_locked_tanpa_lampiran_penjamin_sama_sekali_tidak_membuat_claim(): void
    {
        $invoice = Invoice::factory()->create([
            'total_amount' => 100000,
            'status' => 'open',
            'is_locked' => true,
        ]);

        InvoiceLocked::dispatch($invoice);

        $this->assertDatabaseCount('claim_invoices', 0);
    }

    public function test_event_terpicu_dua_kali_tetap_hanya_satu_claim_invoice(): void
    {
        $invoice = Invoice::factory()->create([
            'total_amount' => 500000,
            'status' => 'open',
            'is_locked' => true,
        ]);

        $guarantor = Guarantor::factory()->bpjs()->create();

        InvoiceGuarantor::factory()->create([
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'covered_amount' => 400000,
        ]);

        // InvoiceService::lock() lalu markPaid() sama-sama dispatch event ini
        // pada invoice yang sama - listener harus idempoten.
        InvoiceLocked::dispatch($invoice);
        InvoiceLocked::dispatch($invoice);

        $this->assertDatabaseCount('claim_invoices', 1);
    }

    public function test_invoice_locked_cancelled_tidak_membuat_claim(): void
    {
        $invoice = Invoice::factory()->create([
            'total_amount' => 500000,
            'status' => 'cancelled',
            'is_locked' => true,
        ]);

        $guarantor = Guarantor::factory()->bpjs()->create();

        InvoiceGuarantor::factory()->create([
            'invoice_id' => $invoice->id,
            'guarantor_id' => $guarantor->id,
            'covered_amount' => 400000,
        ]);

        InvoiceLocked::dispatch($invoice);

        $this->assertDatabaseCount('claim_invoices', 0);
    }
}
