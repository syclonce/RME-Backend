<?php

namespace Modules\PendaftaranVisitDestination\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranWardQueue\Models\WardQueue;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;
use Tests\TestCase;

class VisitDestinationControllerTest extends TestCase
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

    public function test_destination_can_be_created_for_a_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        $ward = Ward::factory()->create();

        $response = $this->postJson('/api/v1/pendaftaranvisitdestinations', [
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('visit_destinations', [
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
            'status' => VisitDestination::STATUS_PENDING,
        ]);
    }

    /** Aturan legacy: satu pendaftaran hanya boleh punya satu tujuan (PK NOPEN). */
    public function test_registration_cannot_have_two_destinations(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        $ward = Ward::factory()->create();
        VisitDestination::create(['registration_id' => $registration->id, 'ward_id' => $ward->id]);

        $response = $this->postJson('/api/v1/pendaftaranvisitdestinations', [
            'registration_id' => $registration->id,
            'ward_id' => Ward::factory()->create()->id,
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('registration_id');
    }

    /** Pemindahan setelah diterima harus lewat mutasi/konsul, bukan menimpa tujuan. */
    public function test_accepted_destination_cannot_change_ward(): void
    {
        $this->actingUser();
        $destination = VisitDestination::create([
            'registration_id' => Registration::factory()->create()->id,
            'ward_id' => Ward::factory()->create()->id,
            'status' => VisitDestination::STATUS_ACCEPTED,
        ]);

        $response = $this->putJson("/api/v1/pendaftaranvisitdestinations/{$destination->id}", [
            'ward_id' => Ward::factory()->create()->id,
        ]);

        $response->assertStatus(422);
    }

    public function test_pending_destination_can_change_ward(): void
    {
        $this->actingUser();
        $destination = VisitDestination::create([
            'registration_id' => Registration::factory()->create()->id,
            'ward_id' => Ward::factory()->create()->id,
        ]);
        $newWard = Ward::factory()->create();

        $this->putJson("/api/v1/pendaftaranvisitdestinations/{$destination->id}", [
            'ward_id' => $newWard->id,
        ])->assertOk();

        $this->assertDatabaseHas('visit_destinations', ['id' => $destination->id, 'ward_id' => $newWard->id]);
    }

    /** Pembatalan mencatat keadaan, tidak menghapus baris. */
    public function test_destroy_cancels_instead_of_deleting(): void
    {
        $this->actingUser();
        $destination = VisitDestination::create([
            'registration_id' => Registration::factory()->create()->id,
            'ward_id' => Ward::factory()->create()->id,
        ]);

        $this->deleteJson("/api/v1/pendaftaranvisitdestinations/{$destination->id}")->assertOk();

        $this->assertDatabaseHas('visit_destinations', [
            'id' => $destination->id,
            'status' => VisitDestination::STATUS_CANCELLED,
        ]);
    }

    public function test_accepted_destination_cannot_be_cancelled(): void
    {
        $this->actingUser();
        $destination = VisitDestination::create([
            'registration_id' => Registration::factory()->create()->id,
            'ward_id' => Ward::factory()->create()->id,
            'status' => VisitDestination::STATUS_ACCEPTED,
        ]);

        $this->deleteJson("/api/v1/pendaftaranvisitdestinations/{$destination->id}")->assertStatus(422);
    }

    /** Antrean poli = tujuan yang belum diterima, difilter per ruangan. */
    public function test_pending_only_filter_returns_queue_for_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        VisitDestination::create(['registration_id' => Registration::factory()->create()->id, 'ward_id' => $ward->id]);
        VisitDestination::create([
            'registration_id' => Registration::factory()->create()->id,
            'ward_id' => $ward->id,
            'status' => VisitDestination::STATUS_ACCEPTED,
        ]);

        $response = $this->getJson("/api/v1/pendaftaranvisitdestinations?ward_id={$ward->id}&pending_only=1");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    /**
     * Sambungan tujuan -> kunjungan: menerima pasien mengeluarkan dia dari
     * antrean poli. Port KunjunganResource::create simgos2 (b.99-103).
     */
    public function test_admitting_patient_marks_destination_accepted(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        $ward = Ward::factory()->create();
        $destination = VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ]);

        $this->postJson('/api/v1/visits', [
            'registration_id' => $registration->id,
            'admitted_at' => now()->toDateTimeString(),
        ])->assertCreated();

        $this->assertSame(VisitDestination::STATUS_ACCEPTED, $destination->fresh()->status);
    }

    /** Tujuan yang sudah dibatalkan tidak boleh dihidupkan oleh kunjungan susulan. */
    public function test_cancelled_destination_is_not_revived_by_admission(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        $destination = VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => Ward::factory()->create()->id,
            'status' => VisitDestination::STATUS_CANCELLED,
        ]);

        $this->postJson('/api/v1/visits', [
            'registration_id' => $registration->id,
            'admitted_at' => now()->toDateTimeString(),
        ])->assertCreated();

        $this->assertSame(VisitDestination::STATUS_CANCELLED, $destination->fresh()->status);
    }

    /** Tujuan dibuat -> pasien langsung masuk antrean (port trigger onAfterInsertTujuanPasien). */
    public function test_creating_destination_enqueues_patient(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/pendaftaranvisitdestinations', [
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ])->assertCreated();

        $this->assertDatabaseHas('ward_queues', [
            'ward_id' => $ward->id,
            'registration_id' => $registration->id,
            'queue_number' => 1,
            'status' => WardQueue::STATUS_WAITING,
        ]);
    }

    /** Nomor antrean berurut per ruangan per hari. */
    public function test_queue_numbers_increment_per_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        foreach ([1, 2, 3] as $expected) {
            $registration = Registration::factory()->create();
            $this->postJson('/api/v1/pendaftaranvisitdestinations', [
                'registration_id' => $registration->id,
                'ward_id' => $ward->id,
            ])->assertCreated();

            $this->assertDatabaseHas('ward_queues', [
                'registration_id' => $registration->id,
                'queue_number' => $expected,
            ]);
        }
    }

    /** Penerimaan pasien menutup antreannya dan menautkannya ke kunjungan. */
    public function test_admission_marks_queue_served_and_links_visit(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/pendaftaranvisitdestinations', [
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ])->assertCreated();

        $response = $this->postJson('/api/v1/visits', [
            'registration_id' => $registration->id,
            'admitted_at' => now()->toDateTimeString(),
        ])->assertCreated();

        $visitId = $response->json('data.id') ?? $response->json('id');

        $this->assertDatabaseHas('ward_queues', [
            'registration_id' => $registration->id,
            'status' => WardQueue::STATUS_SERVED,
            'visit_id' => $visitId,
        ]);
    }
}
