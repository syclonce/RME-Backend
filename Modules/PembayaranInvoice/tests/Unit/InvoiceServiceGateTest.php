<?php

namespace Modules\PembayaranInvoice\Tests\Unit;

use App\Modules\Contracts\BillingGate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\PembayaranInvoice\Services\InvoiceService;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class InvoiceServiceGateTest extends TestCase
{
    use RefreshDatabase;

    protected InvoiceService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(InvoiceService::class);
    }

    protected function createInvoice(array $attributes = []): Invoice
    {
        return Invoice::factory()->create($attributes);
    }

    public function test_lock_mengunci_dan_unlock_membuka_invoice(): void
    {
        $invoice = $this->createInvoice(['is_locked' => false]);

        $this->service->lock($invoice->id);
        $this->assertTrue($invoice->refresh()->is_locked);

        $this->service->unlock($invoice->id);
        $this->assertFalse($invoice->refresh()->is_locked);
    }

    public function test_is_visit_locked_true_bila_ada_invoice_terkunci(): void
    {
        $visit = Visit::factory()->create();
        $this->createInvoice(['visit_id' => $visit->id, 'is_locked' => true]);

        $this->assertTrue($this->service->isVisitLocked($visit->id));
    }

    public function test_is_visit_locked_false_bila_semua_invoice_terbuka(): void
    {
        $visit = Visit::factory()->create();
        $this->createInvoice(['visit_id' => $visit->id, 'is_locked' => false]);

        $this->assertFalse($this->service->isVisitLocked($visit->id));
    }

    public function test_is_visit_locked_false_bila_kunjungan_tanpa_invoice(): void
    {
        $visit = Visit::factory()->create();

        $this->assertFalse($this->service->isVisitLocked($visit->id));
    }

    public function test_unlock_menolak_invoice_lunas(): void
    {
        $invoice = $this->createInvoice(['status' => 'paid', 'is_locked' => true]);

        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $this->service->unlock($invoice->id);
    }

    public function test_unlock_menolak_invoice_batal(): void
    {
        $invoice = $this->createInvoice(['status' => 'cancelled', 'is_locked' => true]);

        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $this->service->unlock($invoice->id);
    }

    public function test_cancel_menolak_invoice_yang_sudah_masuk_klaim(): void
    {
        $invoice = $this->createInvoice(['status' => 'open']);
        ClaimFile::factory()->create([
            'invoice_id' => $invoice->id,
            'visit_id' => $invoice->visit_id,
            'status' => ClaimFile::STATUS_SUBMITTED,
        ]);

        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $this->service->cancel($invoice->id);
    }

    public function test_cancel_tetap_bisa_saat_klaim_masih_draft_atau_rejected(): void
    {
        foreach ([ClaimFile::STATUS_DRAFT, ClaimFile::STATUS_REJECTED] as $status) {
            $invoice = $this->createInvoice(['status' => 'open']);
            ClaimFile::factory()->create([
                'invoice_id' => $invoice->id,
                'visit_id' => $invoice->visit_id,
                'status' => $status,
            ]);

            $this->service->cancel($invoice->id);
            $this->assertSame('cancelled', $invoice->refresh()->status);
        }
    }

    public function test_service_terikat_sebagai_billing_gate(): void
    {
        $this->assertInstanceOf(InvoiceService::class, app(BillingGate::class));
    }
}
