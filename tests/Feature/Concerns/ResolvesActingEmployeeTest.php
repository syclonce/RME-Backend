<?php

namespace Tests\Feature\Concerns;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

/**
 * Kolom "pelaku" (recorded_by, author_id, assessed_by, ...) menunjuk
 * `employees`, BUKAN `users`, dan sebelumnya wajib dikirim klien di 52 modul.
 * Artinya petugas harus menghafal id pegawainya sendiri untuk mencatat satu
 * asesmen.
 *
 * Diuji lewat dua modul dengan bentuk berbeda: controller biasa
 * (ClinicalNote) dan lewat Service (PatientNutritionProblem).
 */
class ResolvesActingEmployeeTest extends TestCase
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

    public function test_author_is_filled_from_employee_profile(): void
    {
        $user = $this->actingUser();
        $employee = Employee::factory()->create(['user_id' => $user->id]);
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/clinical-notes', [
            'visit_id' => $visit->id,
            'subjective' => 'Nyeri kepala sejak semalam.',
        ])->assertCreated();

        $this->assertDatabaseHas('clinical_notes', [
            'visit_id' => $visit->id,
            'author_id' => $employee->id,
        ]);
    }

    /** Nilai yang dikirim klien secara eksplisit tidak boleh ditimpa. */
    public function test_explicit_author_is_not_overwritten(): void
    {
        $user = $this->actingUser();
        Employee::factory()->create(['user_id' => $user->id]);
        $other = Employee::factory()->create();
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/clinical-notes', [
            'visit_id' => $visit->id,
            'subjective' => 'Ditulis atas nama dokter jaga.',
            'author_id' => $other->id,
        ])->assertCreated();

        $this->assertDatabaseHas('clinical_notes', ['author_id' => $other->id]);
    }

    /**
     * Kolomnya NOT NULL. Tanpa penanganan eksplisit, user tanpa profil pegawai
     * menabrak constraint database dan muncul di layar sebagai 500 tanpa
     * keterangan apa pun.
     */
    public function test_user_without_employee_profile_gets_actionable_error(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/clinical-notes', [
            'visit_id' => $visit->id,
            'subjective' => 'Tanpa profil pegawai.',
        ])->assertStatus(422)
          ->assertJsonPath('message', fn ($m) => str_contains((string) $m, 'belum tertaut ke data pegawai'));

        $this->assertDatabaseCount('clinical_notes', 0);
    }

    /** Jalur Service (bukan controller) harus berperilaku sama. */
    public function test_service_backed_module_fills_actor_too(): void
    {
        $user = $this->actingUser();
        $employee = Employee::factory()->create(['user_id' => $user->id]);
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/patient-nutrition-problems', [
            'visit_id' => $visit->id,
            'problem_category' => 'asupan',
            'problem_description' => 'Asupan energi kurang dari kebutuhan.',
        ])->assertCreated();

        $this->assertDatabaseHas('patient_nutrition_problems', [
            'visit_id' => $visit->id,
            'identified_by' => $employee->id,
        ]);
    }
}
