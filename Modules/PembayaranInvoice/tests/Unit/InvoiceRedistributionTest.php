<?php

namespace Modules\PembayaranInvoice\Tests\Unit;

use App\Events\InvoiceLocked;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoice\Services\InvoiceService;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\PendaftaranVisit\Models\Visit;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

/**
 * Port semantik rutin pembayaran.* simgos2: buatTagihan, storePenjaminTagihan,
 * reProsesDistribusiTarif, getTotalPenjaminTagihan.
 */
class InvoiceRedistributionTest extends TestCase
{
    use RefreshDatabase;

    protected InvoiceService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(InvoiceService::class);
    }

    public function test_ensure_for_visit_get_or_create_idempoten(): void
    {
        $visit = Visit::factory()->create();

        $first = $this->service->ensureForVisit($visit->id);
        $second = $this->service->ensureForVisit($visit->id);

        // Ala buatTagihan: panggilan berulang mengembalikan tagihan yang sama.
        $this->assertSame($first->id, $second->id);
        $this->assertSame(1, Invoice::query()->where('visit_id', $visit->id)->count());
    }

    public function test_ensure_for_visit_kunjungan_tak_dikenal_gagal_404(): void
    {
        // Di luar HTTP findOrFail melempar ModelNotFoundException; handler baru
        // mengonversinya menjadi 404.
        $this->assertThrows(fn () => $this->service->ensureForVisit(999999), \Illuminate\Database\Eloquent\ModelNotFoundException::class);
    }

    public function test_attach_guarantor_idempoten_dengan_sequence_berurutan(): void
    {
        $invoice = Invoice::factory()->create();
        $bpjs = Guarantor::factory()->bpjs()->create(['registration_id' => $invoice->visit->registration_id]);
        $selfPay = Guarantor::factory()->create(['registration_id' => $invoice->visit->registration_id]);

        $first = $this->service->attachGuarantor($invoice, $bpjs->id);
        $duplicate = $this->service->attachGuarantor($invoice, $bpjs->id);
        $second = $this->service->attachGuarantor($invoice, $selfPay->id);

        $this->assertSame($first->id, $duplicate->id);
        $this->assertSame(1, (int) $first->sequence);
        $this->assertSame(2, (int) $second->sequence);
        $this->assertSame(2, $invoice->guarantorAttachments()->count());
    }

    public function test_attach_ke_invoice_terkunci_ditolak_422(): void
    {
        $invoice = Invoice::factory()->locked()->create();
        $guarantor = Guarantor::factory()->create(['registration_id' => $invoice->visit->registration_id]);

        try {
            $this->service->attachGuarantor($invoice, $guarantor->id);
            $this->fail('Harusnya ditolak.');
        } catch (HttpException $e) {
            $this->assertSame(422, $e->getStatusCode());
        }
    }

    public function test_redistribute_bpjs_menanggung_penuh_pasien_nol(): void
    {
        $total = '150000.00';
        $invoice = Invoice::factory()->create(['total_amount' => $total, 'subtotal' => $total]);
        Guarantor::factory()->bpjs()->create(['registration_id' => $invoice->visit->registration_id]);

        $this->service->redistribute($invoice);
        $invoice->refresh();

        $coverage = $this->service->coverage($invoice);
        $this->assertSame($total, $coverage['covered']);
        $this->assertSame('0.00', $coverage['patient_share']);
    }

    public function test_redistribute_self_pay_saja_seluruh_jadi_tanggungan_pasien(): void
    {
        $total = '75000.50';
        $invoice = Invoice::factory()->create(['total_amount' => $total, 'subtotal' => $total]);
        Guarantor::factory()->create(['registration_id' => $invoice->visit->registration_id]);

        $this->service->redistribute($invoice);

        $coverage = $this->service->coverage($invoice);
        $this->assertSame('0.00', $coverage['covered']);
        $this->assertSame($total, $coverage['patient_share']);
    }

    public function test_redistribute_penjamin_non_self_pay_pertama_by_urutan_yang_menanggung(): void
    {
        $total = '200000.00';
        $invoice = Invoice::factory()->create(['total_amount' => $total, 'subtotal' => $total]);
        $registrationId = $invoice->visit->registration_id;

        $selfPay = Guarantor::factory()->create(['registration_id' => $registrationId]);
        $corporate = Guarantor::factory()->create(['registration_id' => $registrationId, 'payer_type' => 'corporate']);

        $this->service->redistribute($invoice);

        // Urutan deterministik by id: self_pay duluan tapi bukan penanggung;
        // non-self_pay PERTAMA (corporate) menanggung seluruh total.
        $attachments = $invoice->refresh()->guarantorAttachments;
        $this->assertSame($selfPay->id, (int) $attachments[0]->guarantor_id);
        $this->assertSame('0.00', (string) $attachments[0]->covered_amount);
        $this->assertSame($corporate->id, (int) $attachments[1]->guarantor_id);
        $this->assertSame($total, (string) $attachments[1]->covered_amount);
    }

    public function test_redistribute_membuang_lampiran_guarantor_nonaktif(): void
    {
        $invoice = Invoice::factory()->create();
        $guarantor = Guarantor::factory()->bpjs()->create(['registration_id' => $invoice->visit->registration_id]);

        $this->service->attachGuarantor($invoice, $guarantor->id);
        $guarantor->update(['status' => 'inactive']);

        $this->service->redistribute($invoice);

        $this->assertSame(0, $invoice->refresh()->guarantorAttachments()->count());
    }

    public function test_redistribute_idempoten_angka_tidak_melebar(): void
    {
        $total = '90000.00';
        $invoice = Invoice::factory()->create(['total_amount' => $total, 'subtotal' => $total]);
        Guarantor::factory()->bpjs()->create(['registration_id' => $invoice->visit->registration_id]);

        $this->service->redistribute($invoice);
        $this->service->redistribute($invoice);

        // Ala reProsesDistribusiTarif reset-then-recompute: hasil sama persis.
        $coverage = $this->service->coverage($invoice);
        $this->assertSame($total, $coverage['covered']);
        $this->assertSame('0.00', $coverage['patient_share']);
    }

    public function test_lock_mengirim_event_invoice_locked(): void
    {
        Event::fake([InvoiceLocked::class]);

        $invoice = Invoice::factory()->create();
        $this->service->lock($invoice->id);

        Event::assertDispatchedTimes(InvoiceLocked::class, 1);
        $this->assertTrue($invoice->refresh()->is_locked);
    }

    public function test_unlock_tidak_mengirim_event(): void
    {
        Event::fake([InvoiceLocked::class]);

        // Unlock hanya untuk invoice terbuka (paid/cancelled ditolak 422
        // ala legacy TagihanResource:157) — unlock tetap tanpa event.
        $invoice = Invoice::factory()->create(['is_locked' => true]);
        $this->service->unlock($invoice->id);

        Event::assertNotDispatched(InvoiceLocked::class);
        $this->assertFalse($invoice->refresh()->is_locked);
    }
}
