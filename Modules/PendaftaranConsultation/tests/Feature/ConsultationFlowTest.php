<?php

namespace Modules\PendaftaranConsultation\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\GeneralWard\Models\Ward;
use Modules\GeneralMedicalDepartmentWardAssignment\Models\MedicalDepartmentWardAssignment;
use Modules\PendaftaranConsultation\Models\Consultation;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class ConsultationFlowTest extends TestCase
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

    /**
     * Menjawab konsul menuntut profil pegawai, karena `answered_by` menunjuk
     * tabel `employees` — yang menjawab konsul adalah dokter.
     */
    private function actingDoctor(): Employee
    {
        $user = $this->actingUser();

        return Employee::factory()->create(['user_id' => $user->id]);
    }

    private function makeConsultation(): Consultation
    {
        return Consultation::create([
            'visit_id' => Visit::factory()->create()->id,
            'requesting_department_id' => MedicalDepartment::factory()->create()->id,
            'consulted_department_id' => MedicalDepartment::factory()->create()->id,
            'question' => 'Mohon konsul jantung.',
            'requested_at' => now(),
            'status' => Consultation::STATUS_PENDING,
        ]);
    }

    public function test_consultation_starts_as_pending(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/consultations', [
            'visit_id' => $visit->id,
            'requesting_department_id' => MedicalDepartment::factory()->create()->id,
            'consulted_department_id' => MedicalDepartment::factory()->create()->id,
            'question' => 'Mohon konsul jantung.',
        ])->assertCreated();

        $this->assertDatabaseHas('consultations', [
            'visit_id' => $visit->id,
            'status' => Consultation::STATUS_PENDING,
        ]);
    }

    /** Padanan `/pendaftaran/jawabankonsul` legacy — unit tujuan menutup konsul. */
    public function test_answering_closes_the_consultation(): void
    {
        $doctor = $this->actingDoctor();
        $consultation = $this->makeConsultation();

        $this->postJson("/api/v1/consultations/{$consultation->id}/answer", [
            'answer' => 'Tidak ditemukan kelainan bermakna.',
        ])->assertOk();

        $fresh = $consultation->fresh();
        $this->assertSame(Consultation::STATUS_ANSWERED, $fresh->status);
        $this->assertNotNull($fresh->answered_at);

        $this->assertDatabaseHas('consultation_answers', [
            'consultation_id' => $consultation->id,
            'answered_by' => $doctor->id,
        ]);
    }

    /** `answered_at` menunjuk jawaban PERTAMA — itu yang mengukur waktu tanggap unit. */
    public function test_second_answer_does_not_move_first_answer_time(): void
    {
        $this->actingDoctor();
        $consultation = $this->makeConsultation();

        $this->postJson("/api/v1/consultations/{$consultation->id}/answer", ['answer' => 'Jawaban pertama.'])->assertOk();
        $firstAnsweredAt = $consultation->fresh()->answered_at;

        $this->travel(5)->minutes();
        $this->postJson("/api/v1/consultations/{$consultation->id}/answer", ['answer' => 'Tambahan.'])->assertOk();

        $this->assertEquals($firstAnsweredAt, $consultation->fresh()->answered_at);
        $this->assertSame(2, $consultation->answers()->count());
    }

    public function test_pending_consultation_can_be_cancelled(): void
    {
        $this->actingUser();
        $consultation = $this->makeConsultation();

        $this->postJson("/api/v1/consultations/{$consultation->id}/cancel")->assertOk();

        $this->assertSame(Consultation::STATUS_CANCELLED, $consultation->fresh()->status);
    }

    public function test_answered_consultation_cannot_be_cancelled(): void
    {
        $this->actingUser();
        $consultation = $this->makeConsultation();
        $consultation->update(['status' => Consultation::STATUS_ANSWERED]);

        $this->postJson("/api/v1/consultations/{$consultation->id}/cancel")->assertStatus(422);
    }

    public function test_cancelled_consultation_cannot_be_answered(): void
    {
        $this->actingDoctor();
        $consultation = $this->makeConsultation();
        $consultation->update(['status' => Consultation::STATUS_CANCELLED]);

        $this->postJson("/api/v1/consultations/{$consultation->id}/answer", [
            'answer' => 'Terlambat.',
        ])->assertStatus(422);
    }

    /** Daftar kerja unit tujuan: hanya konsul yang belum dijawab. */
    public function test_pending_only_filter_lists_open_consultations(): void
    {
        $this->actingUser();
        $this->makeConsultation();
        $answered = $this->makeConsultation();
        $answered->update(['status' => Consultation::STATUS_ANSWERED]);

        $this->getJson('/api/v1/consultations?pending_only=1')
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    /**
     * Pola legacy: konsul yang dijawab MELAHIRKAN kunjungan di unit konsulen,
     * menunjuk balik ke konsulnya (padanan `kunjungan.REF` prefix 10).
     */
    public function test_answering_creates_derived_visit_in_consulted_ward(): void
    {
        $this->actingDoctor();
        $ward = Ward::factory()->create();
        $department = MedicalDepartment::factory()->create();
        MedicalDepartmentWardAssignment::create([
            'medical_department_id' => $department->id,
            'ward_id' => $ward->id,
            'is_primary' => true,
        ]);

        $visit = Visit::factory()->create();
        $consultation = Consultation::create([
            'visit_id' => $visit->id,
            'requesting_department_id' => MedicalDepartment::factory()->create()->id,
            'consulted_department_id' => $department->id,
            'question' => 'Mohon konsul.',
            'requested_at' => now(),
            'status' => Consultation::STATUS_PENDING,
        ]);

        $this->postJson("/api/v1/consultations/{$consultation->id}/answer", [
            'answer' => 'Sudah diperiksa.',
        ])->assertOk();

        $this->assertDatabaseHas('visits', [
            'registration_id' => $visit->registration_id,
            'ward_id' => $ward->id,
            'origin_type' => Consultation::class,
            'origin_id' => $consultation->id,
        ]);
    }

    /** Jawaban susulan adalah tambahan pelayanan yang sama, bukan kunjungan baru. */
    public function test_second_answer_does_not_create_another_visit(): void
    {
        $this->actingDoctor();
        $ward = Ward::factory()->create();
        $department = MedicalDepartment::factory()->create();
        MedicalDepartmentWardAssignment::create([
            'medical_department_id' => $department->id,
            'ward_id' => $ward->id,
            'is_primary' => true,
        ]);

        $consultation = Consultation::create([
            'visit_id' => Visit::factory()->create()->id,
            'requesting_department_id' => MedicalDepartment::factory()->create()->id,
            'consulted_department_id' => $department->id,
            'question' => 'Mohon konsul.',
            'requested_at' => now(),
            'status' => Consultation::STATUS_PENDING,
        ]);

        $this->postJson("/api/v1/consultations/{$consultation->id}/answer", ['answer' => 'Pertama.'])->assertOk();
        $this->postJson("/api/v1/consultations/{$consultation->id}/answer", ['answer' => 'Kedua.'])->assertOk();

        $this->assertSame(1, Visit::query()->where('origin_id', $consultation->id)->count());
    }

    /** Unit tanpa ruangan terpetakan: konsul tetap terjawab, kunjungan dilewati. */
    public function test_answer_succeeds_when_department_has_no_ward(): void
    {
        $this->actingDoctor();
        $consultation = $this->makeConsultation();

        $this->postJson("/api/v1/consultations/{$consultation->id}/answer", [
            'answer' => 'Sudah diperiksa.',
        ])->assertOk();

        $this->assertSame(Consultation::STATUS_ANSWERED, $consultation->fresh()->status);
    }
}
