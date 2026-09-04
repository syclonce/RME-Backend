<?php

namespace Modules\PendaftaranVisit\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralStaffWardAssignment\Models\StaffWardAssignment;
use Modules\GeneralWard\Models\Ward;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\PembayaranInvoice\Services\InvoiceService;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class VisitControllerTest extends TestCase
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

    /** Petugas yang ditugaskan HANYA ke $wardId (least-privilege #3). */
    private function actingWardStaff(int $wardId): User
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $employee = Employee::factory()->create(['user_id' => $user->id]);
        $staffMember = StaffMember::factory()->create(['employee_id' => $employee->id]);
        StaffWardAssignment::factory()->create(['staff_member_id' => $staffMember->id, 'ward_id' => $wardId]);
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_ward_staff_cannot_admit_visit_to_another_ward(): void
    {
        $ownWard = Ward::factory()->create();
        $otherWard = Ward::factory()->create();
        $this->actingWardStaff($ownWard->id);
        $registration = Registration::factory()->create();

        $this->postJson('/api/v1/visits', [
            'registration_id' => $registration->id,
            'ward_id' => $otherWard->id,
        ])->assertStatus(403);
    }

    public function test_ward_staff_can_admit_visit_to_own_ward(): void
    {
        $ownWard = Ward::factory()->create();
        $this->actingWardStaff($ownWard->id);
        $registration = Registration::factory()->create();

        $this->postJson('/api/v1/visits', [
            'registration_id' => $registration->id,
            'ward_id' => $ownWard->id,
        ])->assertCreated();
    }

    /**
     * ward_id null = kunjungan rawat jalan (tidak menempati bed) — dipakai
     * VisitController::index() sebagai penanda agar petugas ward tetap bisa
     * melihatnya. Test ini mengunci kontrak tersebut supaya tidak tak sengaja
     * diubah menjadi wajib.
     */
    public function test_outpatient_visit_can_be_created_without_ward(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();

        $this->postJson('/api/v1/visits', [
            'registration_id' => $registration->id,
        ])->assertCreated();

        $this->assertDatabaseHas('visits', [
            'registration_id' => $registration->id,
            'ward_id' => null,
        ]);
    }

    /** DPJP opsional — di IGD kerap baru ditentukan setelah triase. */
    public function test_visit_can_be_created_without_attending_physician(): void
    {
        $ward = Ward::factory()->create();
        $this->actingWardStaff($ward->id);
        $registration = Registration::factory()->create();

        $this->postJson('/api/v1/visits', [
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ])
            ->assertCreated()
            ->assertJsonPath('data.attending_physician_id', null);
    }

    public function test_ward_staff_cannot_cancel_visit_in_another_ward(): void
    {
        $ownWard = Ward::factory()->create();
        $otherWard = Ward::factory()->create();
        $this->actingWardStaff($ownWard->id);
        $visit = Visit::factory()->create(['ward_id' => $otherWard->id]);

        $this->deleteJson("/api/v1/visits/{$visit->id}")->assertStatus(403);
    }

    public function test_it_admits_a_visit_under_a_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();

        $response = $this->postJson('/api/v1/visits', ['registration_id' => $registration->id]);

        $response->assertCreated();
        $this->assertStringStartsWith('KJ-'.now()->format('Y').'-', $response->json('data.visit_number'));
    }

    public function test_it_lists_visits_filtered_by_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        Visit::factory()->count(2)->create(['registration_id' => $registration->id]);
        Visit::factory()->create();

        $response = $this->getJson("/api/v1/visits?registration_id={$registration->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_blocks_discharge_via_update_and_points_to_the_gate(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();

        // Gerbang pulang #11: edit bebas tidak boleh memutir discharged_at —
        // bed wajib dibebaskan lewat POST /visits/{visit}/discharge.
        $response = $this->putJson("/api/v1/visits/{$visit->id}", [
            'discharged_at' => now()->toIso8601String(),
            'final_outcome' => 'sembuh',
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseHas('visits', ['id' => $visit->id, 'discharged_at' => null]);
    }

    public function test_it_cancels_a_visit_and_releases_the_bed(): void
    {
        $this->actingUser();
        $bed = Bed::factory()->create(['status' => Bed::STATUS_OCCUPIED]);
        $visit = Visit::factory()->create(['ward_id' => $bed->room->ward_id, 'bed_id' => $bed->id]);

        $response = $this->deleteJson("/api/v1/visits/{$visit->id}");

        $response->assertStatus(204);
        $this->assertDatabaseHas('visits', ['id' => $visit->id, 'status' => 'cancelled']);
        $this->assertSame(Bed::STATUS_AVAILABLE, $bed->fresh()->status);
    }

    public function test_it_blocks_cancel_when_billing_is_locked(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        ClinicalNote::factory()->create(['visit_id' => $visit->id]);
        Diagnosis::factory()->primary()->create(['visit_id' => $visit->id]);
        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/start")->assertCreated();
        $this->postJson("/api/v1/visits/{$visit->id}/medical-record/finalize")->assertOk();
        $this->postJson("/api/v1/visits/{$visit->id}/finalize-service")->assertOk();

        $invoice = app(InvoiceService::class)->ensureForVisit($visit->id);
        app(InvoiceService::class)->lock($invoice->id);

        $response = $this->deleteJson("/api/v1/visits/{$visit->id}");

        $response->assertStatus(422);
        $this->assertDatabaseHas('visits', ['id' => $visit->id, 'status' => 'active']);
    }

    public function test_it_ignores_status_field_injected_at_admit(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();

        $response = $this->postJson('/api/v1/visits', [
            'registration_id' => $registration->id,
            'status' => 'discharged',
        ]);

        // status bukan field yang divalidasi -- diabaikan, bukan bikin 422.
        $response->assertCreated();
        $this->assertDatabaseHas('visits', ['registration_id' => $registration->id, 'status' => 'active']);
    }

    public function test_ward_staff_cannot_read_visit_in_another_ward(): void
    {
        $ownWard = Ward::factory()->create();
        $otherWard = Ward::factory()->create();
        $this->actingWardStaff($ownWard->id);
        $visit = Visit::factory()->create(['ward_id' => $otherWard->id]);

        $this->getJson("/api/v1/visits/{$visit->id}")->assertStatus(403);
    }

    public function test_ward_staff_can_read_visit_in_own_ward(): void
    {
        $ownWard = Ward::factory()->create();
        $this->actingWardStaff($ownWard->id);
        $visit = Visit::factory()->create(['ward_id' => $ownWard->id]);

        $this->getJson("/api/v1/visits/{$visit->id}")->assertOk();
    }

    public function test_it_lists_visits_filtered_by_status(): void
    {
        $this->actingUser();
        Visit::factory()->create(['status' => 'active']);
        $cancelled = Visit::factory()->create(['status' => 'cancelled']);

        $response = $this->getJson('/api/v1/visits?status=cancelled');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertSame($cancelled->id, $response->json('data.0.id'));
    }

    public function test_it_lists_visits_filtered_by_is_emergency(): void
    {
        $this->actingUser();
        // is_emergency ada di registrations, bukan visits, jadi filter harus
        // ikut relasi registration() (whereHas), bukan kolom langsung.
        $emergencyRegistration = Registration::factory()->emergency()->create();
        $emergencyVisit = Visit::factory()->create(['registration_id' => $emergencyRegistration->id]);
        $nonEmergencyRegistration = Registration::factory()->create();
        Visit::factory()->create(['registration_id' => $nonEmergencyRegistration->id]);

        $response = $this->getJson('/api/v1/visits?is_emergency=1');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertSame($emergencyVisit->id, $response->json('data.0.id'));
    }

    public function test_it_lists_all_visits_when_no_filter_given(): void
    {
        $this->actingUser();
        Visit::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/visits');

        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_ward_staff_list_excludes_visits_from_other_wards(): void
    {
        $ownWard = Ward::factory()->create();
        $otherWard = Ward::factory()->create();
        $this->actingWardStaff($ownWard->id);
        $ownVisit = Visit::factory()->create(['ward_id' => $ownWard->id]);
        Visit::factory()->create(['ward_id' => $otherWard->id]);
        $outpatientVisit = Visit::factory()->create(['ward_id' => null]);

        $response = $this->getJson('/api/v1/visits');

        $response->assertOk();
        $ids = array_column($response->json('data'), 'id');
        $this->assertContains($ownVisit->id, $ids);
        $this->assertContains($outpatientVisit->id, $ids);
        $this->assertCount(2, $ids);
    }
}
