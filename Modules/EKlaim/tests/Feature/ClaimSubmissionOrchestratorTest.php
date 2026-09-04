<?php

namespace Modules\EKlaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Modules\EKlaim\Models\EklaimCall;
use Modules\EKlaim\Services\ClaimSubmissionOrchestrator;
use Modules\EKlaim\Services\EklaimService;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;
use Modules\PembayaranInvoice\Models\Invoice;
use Tests\TestCase;

/**
 * Orkestrasi 7 langkah pengajuan klaim.
 *
 * `EklaimService` di-stub: tanpa kredensial E-Klaim, yang bisa dan perlu diuji
 * adalah URUTAN dan penanganan kegagalannya — bukan protokol jaringannya.
 */
class ClaimSubmissionOrchestratorTest extends TestCase
{
    use RefreshDatabase;

    private function claim(string $status = 'draft'): ClaimInvoice
    {
        return ClaimInvoice::create([
            'invoice_id' => Invoice::factory()->create()->id,
            'claim_number' => 'CLM-'.uniqid(),
            'claim_amount' => 5_000_000,
            'status' => $status,
        ]);
    }

    /** Stub yang selalu berhasil, mencatat urutan pemanggilan. */
    private function fakeEklaim(array &$calledOrder, ?string $failAt = null): EklaimService
    {
        return new class($calledOrder, $failAt) extends EklaimService
        {
            public function __construct(private array &$order, private ?string $failAt)
            {
            }

            public function call(string $method, array $data = []): EklaimCall
            {
                $this->order[] = $method;

                return EklaimCall::create([
                    'method' => $method,
                    'request_data' => $data,
                    'status' => $method === $this->failAt ? 'failed' : 'sent',
                    'error_message' => $method === $this->failAt ? 'Tarif INA-CBG tidak ditemukan.' : null,
                ]);
            }
        };
    }

    public function test_submission_runs_all_steps_in_legacy_order(): void
    {
        $order = [];
        $orchestrator = new ClaimSubmissionOrchestrator($this->fakeEklaim($order));
        $claim = $this->claim();

        $orchestrator->submit($claim, ['nomor_sep' => '0001']);

        $this->assertSame(
            ['new_claim', 'set_claim_data', 'grouper', 'claim_final', 'send_claim'],
            $order,
        );
        $this->assertSame('submitted', $claim->fresh()->status);
        $this->assertNotNull($claim->fresh()->submitted_at);
    }

    /**
     * CELAH LEGACY YANG DIPERBAIKI: `V5/Service.php:1435-1439` membungkam kode dan
     * pesan error saat pengiriman gagal. Di sini kegagalan dilaporkan dengan
     * menyebut langkah dan penyebabnya.
     */
    public function test_failure_reports_which_step_failed_and_why(): void
    {
        $order = [];
        $orchestrator = new ClaimSubmissionOrchestrator($this->fakeEklaim($order, failAt: 'grouper'));
        $claim = $this->claim();

        try {
            $orchestrator->submit($claim, []);
            $this->fail('Seharusnya gagal pada langkah grouper.');
        } catch (ValidationException $e) {
            $message = $e->errors()['eklaim'][0];
            $this->assertStringContainsString('grouper', $message);
            $this->assertStringContainsString('Tarif INA-CBG tidak ditemukan.', $message);
        }
    }

    /** Rangkaian BERHENTI pada kegagalan pertama — legacy melanjutkan di atas data tidak sah. */
    public function test_failure_stops_remaining_steps(): void
    {
        $order = [];
        $orchestrator = new ClaimSubmissionOrchestrator($this->fakeEklaim($order, failAt: 'set_claim_data'));

        try {
            $orchestrator->submit($this->claim(), []);
        } catch (ValidationException) {
            // diabaikan; yang diuji adalah langkah setelahnya tidak dijalankan
        }

        $this->assertSame(['new_claim', 'set_claim_data'], $order);
    }

    /** Klaim tetap `draft` setelah gagal, sehingga dapat diajukan ulang. */
    public function test_claim_stays_draft_after_failure(): void
    {
        $order = [];
        $orchestrator = new ClaimSubmissionOrchestrator($this->fakeEklaim($order, failAt: 'send_claim'));
        $claim = $this->claim();

        try {
            $orchestrator->submit($claim, []);
        } catch (ValidationException) {
        }

        $this->assertSame('draft', $claim->fresh()->status);
    }

    /** Klaim ganda ditolak Kemkes saat verifikasi — dicegah di sini. */
    public function test_non_draft_claim_cannot_be_resubmitted(): void
    {
        $order = [];
        $orchestrator = new ClaimSubmissionOrchestrator($this->fakeEklaim($order));

        $this->expectException(ValidationException::class);
        $orchestrator->submit($this->claim('submitted'), []);
    }
}
