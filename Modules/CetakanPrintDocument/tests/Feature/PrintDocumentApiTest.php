<?php

namespace Modules\CetakanPrintDocument\Tests\Feature;

use App\Modules\Contracts\HospitalConfig;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\CetakanPrintDocument\Models\PrintDocument;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralRoom\Models\Room;
use Modules\GeneralWard\Models\Ward;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPayment\Models\Payment;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

/**
 * Penerbitan idempoten ala cetakan.storeKarcis + gerbang konfigurasi
 * PropertiConfig 12/25/29 (gelang/tracer).
 */
class PrintDocumentApiTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();


        $this->seed(RoleAndPermissionSeeder::class);
        $this->user = User::factory()->create();
        $this->user->assignRole('petugas');
        $this->actingAs($this->user, 'sanctum');
    }

    public function test_kwitansi_menerbitkan_payload_lengkap(): void
    {
        $invoice = Invoice::factory()->create(['total_amount' => '150000']);
        $payment = Payment::factory()->create([
            'invoice_id' => $invoice->id,
            'amount' => '50000',
            'payment_method' => 'cash',
        ]);

        $response = $this->postJson('/api/v1/print-documents/issue', [
            'document_type' => 'receipt',
            'ref_type' => 'payments',
            'ref_id' => $payment->id,
        ]);

        $response->assertStatus(201);
        $document = $response->json('data.document');
        $this->assertSame('RCPT-'.now()->format('ymd').'-0001', $document['document_number']);
        $this->assertSame('KWITANSI PEMBAYARAN', $document['payload']['title']);
        $this->assertSame($payment->payment_number, $document['payload']['payment_number']);
        $this->assertEqualsWithDelta(50000.0, $document['payload']['amount'], 0.01);
        $this->assertEqualsWithDelta(150000.0, $document['payload']['invoice']['total_amount'], 0.01);
        $this->assertFalse($response->json('data.reused'));
    }

    public function test_penerbitan_ulang_idempoten_nomor_tidak_berubah(): void
    {
        $registration = \Modules\PendaftaranRegistration\Models\Registration::factory()->create();

        foreach ([false, true] as $ulang) {
            $response = $this->postJson('/api/v1/print-documents/issue', [
                'document_type' => 'karcis',
                'ref_type' => 'registrations',
                'ref_id' => $registration->id,
            ]);
            $response->assertStatus(201);
            $documents[] = $response->json('data.document');
        }

        $this->assertSame($documents[0]['document_number'], $documents[1]['document_number']);
        $this->assertTrue($response->json('data.reused'));
        $this->assertSame(1, PrintDocument::query()->count());
    }

    public function test_karcis_membawa_data_pasien_dari_registrasi(): void
    {
        $registration = \Modules\PendaftaranRegistration\Models\Registration::factory()->create();

        $payload = $this->postJson('/api/v1/print-documents/issue', [
            'document_type' => 'karcis',
            'ref_type' => 'registrations',
            'ref_id' => $registration->id,
        ])->assertStatus(201)->json('data.document.payload');

        $this->assertSame('KARCIS PASIEN', $payload['title']);
        $this->assertSame($registration->registration_number, $payload['registration_number']);
        $this->assertSame($registration->patient->name, $payload['patient']['name']);
    }

    public function test_gelang_ditolak_bila_config_dimatikan(): void
    {
        app(HospitalConfig::class)->set('printing.print_wristband', false, 'bool');

        $visit = Visit::factory()->create([
            'registration_id' => \Modules\PendaftaranRegistration\Models\Registration::factory(),
            'ward_id' => Ward::factory(),
        ]);

        $this->postJson('/api/v1/print-documents/issue', [
            'document_type' => 'wristband',
            'ref_type' => 'visits',
            'ref_id' => $visit->id,
        ])->assertStatus(422);

        $this->assertSame(0, PrintDocument::query()->count());
    }

    public function test_tracer_rawat_inap_ditolak_default_config(): void
    {
        $ward = Ward::factory()->create();
        $bed = Bed::factory()->create(['room_id' => Room::factory()->create(['ward_id' => $ward])->id]);
        $registration = \Modules\PendaftaranRegistration\Models\Registration::factory()->create();

        Visit::factory()->create([
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
            'bed_id' => $bed->id,
        ]);

        // printing.allow_tracer_inpatient default false → tracer RI ditolak.
        $this->postJson('/api/v1/print-documents/issue', [
            'document_type' => 'tracer',
            'ref_type' => 'registrations',
            'ref_id' => $registration->id,
        ])->assertStatus(422);

        // Rawat jalan boleh.
        $rawatJalan = \Modules\PendaftaranRegistration\Models\Registration::factory()->create();
        $this->postJson('/api/v1/print-documents/issue', [
            'document_type' => 'tracer',
            'ref_type' => 'registrations',
            'ref_id' => $rawatJalan->id,
        ])->assertStatus(201);
    }

    public function test_show_dan_list_filter_jenis(): void
    {
        $registration = \Modules\PendaftaranRegistration\Models\Registration::factory()->create();
        $issued = $this->postJson('/api/v1/print-documents/issue', [
            'document_type' => 'karcis',
            'ref_type' => 'registrations',
            'ref_id' => $registration->id,
        ])->json('data.document');

        PrintDocument::query()->create([
            'document_type' => PrintDocument::TYPE_RECEIPT,
            'ref_type' => 'payments',
            'ref_id' => 99,
            'document_number' => 'RCPT-260101-0001',
            'issued_at' => now(),
        ]);

        $this->getJson("/api/v1/print-documents/{$issued['id']}")
            ->assertOk()
            ->assertJsonPath('data.id', $issued['id']);

        $filtered = $this->getJson('/api/v1/print-documents?type=karcis')->assertOk();
        $this->assertCount(1, $filtered->json('data.data'));
        $this->assertSame('karcis', $filtered->json('data.data.0.document_type'));
    }

    public function test_kartu_pasien_menerbitkan_payload_dan_pdf(): void
    {
        $patient = Patient::factory()->create(['name' => 'Budi Santoso', 'medical_record_number' => 'RM-2026-000042']);

        $response = $this->postJson('/api/v1/print-documents/issue', [
            'document_type' => 'patient_card',
            'ref_type' => 'patients',
            'ref_id' => $patient->id,
        ]);

        $response->assertStatus(201);
        $document = $response->json('data.document');
        $this->assertSame('KARTU BEROBAT PASIEN', $document['payload']['title']);
        $this->assertSame('RM-2026-000042', $document['payload']['medical_record_number']);
        $this->assertSame('Budi Santoso', $document['payload']['name']);

        $pdf = $this->get("/api/v1/print-documents/{$document['id']}/pdf");
        $pdf->assertOk();
        $this->assertSame('application/pdf', $pdf->headers->get('Content-Type'));
    }

    public function test_pdf_ditolak_untuk_jenis_selain_kartu_pasien(): void
    {
        $registration = \Modules\PendaftaranRegistration\Models\Registration::factory()->create();
        $document = $this->postJson('/api/v1/print-documents/issue', [
            'document_type' => 'karcis',
            'ref_type' => 'registrations',
            'ref_id' => $registration->id,
        ])->json('data.document');

        $this->get("/api/v1/print-documents/{$document['id']}/pdf")->assertStatus(422);
    }

    public function test_endpoint_tertutup_untuk_tamu(): void
    {
        $this->app['auth']->guard('sanctum')->forgetUser();

        $this->postJson('/api/v1/print-documents/issue', [
            'document_type' => 'karcis',
            'ref_type' => 'registrations',
            'ref_id' => 1,
        ])->assertUnauthorized();
    }
}
