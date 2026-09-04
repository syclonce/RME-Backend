<?php

namespace Modules\BpjsAntreanRs\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\BpjsAntreanRs\Models\BpjsCodeMapping;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;
use Modules\PendaftaranWardQueue\Models\WardQueue;
use Tests\TestCase;

class AntreanFromDestinationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    /** Draf antrean tersusun dari tujuan pasien, bukan diketik ulang pemanggil. */
    public function test_draft_is_composed_from_visit_destination(): void
    {
        $this->actingUser();

        $patient = Patient::factory()->create(['medical_record_number' => 'RM-000123', 'nik' => '3212345678987654']);
        $registration = Registration::factory()->create(['patient_id' => $patient->id]);
        Guarantor::factory()->bpjs()->create([
            'registration_id' => $registration->id,
            'member_number' => '0001234567890',
        ]);
        $ward = Ward::factory()->create(['name' => 'Poli Anak']);
        $destination = VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ]);
        WardQueue::factory()->create([
            'ward_id' => $ward->id,
            'registration_id' => $registration->id,
            'queue_number' => 7,
            'queue_date' => now()->toDateString(),
        ]);

        $response = $this->postJson('/api/v1/antrean-rs/antrean/from-destination', [
            'visit_destination_id' => $destination->id,
            'kodepoli' => 'ANA',
            'kodedokter' => 12345,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('antrean_rs_antreans', [
            'norm' => 'RM-000123',
            'nomorkartu' => '0001234567890',
            'namapoli' => 'Poli Anak',
            'nomorantrean' => '7',
            'angkaantrean' => 7,
            'status' => 'draft',
            'bpjs_sync_status' => 'pending',
            'kodepoli' => 'ANA',
        ]);
    }

    /** Antrean Online BPJS hanya untuk peserta JKN — penjamin lain ditolak. */
    public function test_non_bpjs_registration_is_rejected(): void
    {
        $this->actingUser();

        $registration = Registration::factory()->create();
        Guarantor::factory()->create([
            'registration_id' => $registration->id,
            'payer_type' => 'self_pay',
        ]);
        $ward = Ward::factory()->create();
        $destination = VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ]);

        $response = $this->postJson('/api/v1/antrean-rs/antrean/from-destination', [
            'visit_destination_id' => $destination->id,
            'kodepoli' => 'ANA',
            'kodedokter' => 12345,
        ]);

        $response->assertUnprocessable();
        $this->assertDatabaseCount('antrean_rs_antreans', 0);
    }

    /** Idempoten: tujuan pasien yang sudah punya draf tidak boleh membuat draf kedua. */
    public function test_duplicate_draft_for_same_destination_is_rejected(): void
    {
        $this->actingUser();

        $registration = Registration::factory()->create();
        Guarantor::factory()->bpjs()->create(['registration_id' => $registration->id]);
        $ward = Ward::factory()->create();
        $destination = VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ]);

        $payload = [
            'visit_destination_id' => $destination->id,
            'kodepoli' => 'ANA',
            'kodedokter' => 12345,
        ];

        $this->postJson('/api/v1/antrean-rs/antrean/from-destination', $payload)->assertCreated();
        $response = $this->postJson('/api/v1/antrean-rs/antrean/from-destination', $payload);

        $response->assertUnprocessable();
        $this->assertDatabaseCount('antrean_rs_antreans', 1);
    }

    /** kodepoli/kodedokter TIDAK dipasok -> diturunkan dari pemetaan aktif. */
    public function test_kodepoli_and_kodedokter_are_resolved_from_mapping_when_omitted(): void
    {
        $this->actingUser();

        $patient = Patient::factory()->create();
        $registration = Registration::factory()->create(['patient_id' => $patient->id]);
        Guarantor::factory()->bpjs()->create(['registration_id' => $registration->id]);
        $ward = Ward::factory()->create(['name' => 'Poli Anak']);
        $doctor = Employee::factory()->create(['name' => 'Dr. Budi']);

        BpjsCodeMapping::query()->create(['ward_id' => $ward->id, 'bpjs_code' => 'ANA', 'is_active' => true]);
        BpjsCodeMapping::query()->create(['employee_id' => $doctor->id, 'bpjs_code' => '00123', 'is_active' => true]);

        $destination = VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
            'doctor_id' => $doctor->id,
        ]);

        $response = $this->postJson('/api/v1/antrean-rs/antrean/from-destination', [
            'visit_destination_id' => $destination->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('antrean_rs_antreans', [
            'kodepoli' => 'ANA',
            'kodedokter' => 123,
        ]);
    }

    /** Ward tujuan belum dipetakan -> ditolak 422, bukan dikirim kosong. */
    public function test_rejects_when_ward_has_no_active_mapping(): void
    {
        $this->actingUser();

        $registration = Registration::factory()->create();
        Guarantor::factory()->bpjs()->create(['registration_id' => $registration->id]);
        $ward = Ward::factory()->create(['name' => 'Poli Belum Dipetakan']);
        $destination = VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ]);

        $response = $this->postJson('/api/v1/antrean-rs/antrean/from-destination', [
            'visit_destination_id' => $destination->id,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonFragment(['kodepoli' => ["Ward \"Poli Belum Dipetakan\" belum memiliki pemetaan kodepoli BPJS yang aktif. Petakan lewat menu pemetaan kode BPJS terlebih dahulu, atau pasok kodepoli secara manual."]]);
        $this->assertDatabaseCount('antrean_rs_antreans', 0);
    }
}
