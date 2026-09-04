<?php

namespace Modules\MedicalRecordVitalSign\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use PHPUnit\Framework\Attributes\DataProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordVitalSign\Models\VitalSign;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class VitalSignControllerTest extends TestCase
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

    public function test_it_records_a_vital_sign_reading(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $recordedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/vital-signs', [
            'visit_id' => $visit->id,
            'recorded_by' => $recordedBy->id,
            'temperature' => 38.5,
            'pulse' => 88,
            'systolic' => 120,
            'diastolic' => 80,
        ]);

        $response->assertCreated()->assertJsonPath('data.pulse', 88);
        $this->assertDatabaseHas('vital_signs', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_readings_filtered_by_visit_ordered_latest_first(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $older = VitalSign::factory()->create(['visit_id' => $visit->id, 'recorded_at' => now()->subHour()]);
        $newer = VitalSign::factory()->create(['visit_id' => $visit->id, 'recorded_at' => now()]);
        VitalSign::factory()->create();

        $response = $this->getJson("/api/v1/vital-signs?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
        $this->assertEquals($newer->id, $response->json('data.0.id'));
    }

    public function test_guest_cannot_access_vital_signs(): void
    {
        $this->getJson('/api/v1/vital-signs')->assertStatus(401);
    }

    /**
     * `recorded_by` menunjuk employees, BUKAN users. Sebelum ini ia wajib
     * dikirim klien, artinya perawat harus menghafal id pegawainya sendiri
     * untuk mencatat satu tanda vital.
     */
    public function test_recorded_by_is_filled_from_employee_profile(): void
    {
        $user = $this->actingUser();
        $employee = Employee::factory()->create(['user_id' => $user->id]);
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/vital-signs', [
            'visit_id' => $visit->id,
            'temperature' => 36.8,
            'pulse' => 82,
        ])->assertCreated();

        $this->assertDatabaseHas('vital_signs', [
            'visit_id' => $visit->id,
            'recorded_by' => $employee->id,
        ]);
    }

    /**
     * Kolomnya NOT NULL. User tanpa profil pegawai harus ditolak dengan pesan
     * yang dapat ditindaklanjuti, bukan menabrak constraint database yang
     * muncul di layar sebagai 500 tanpa keterangan.
     */
    public function test_user_without_employee_profile_gets_actionable_error(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/vital-signs', [
            'visit_id' => $visit->id,
            'temperature' => 36.8,
        ])->assertStatus(422)
          ->assertJsonPath('message', fn ($m) => str_contains((string) $m, 'belum tertaut ke data pegawai'));

        $this->assertDatabaseCount('vital_signs', 0);
    }

    /**
     * Angka di luar rentang fisiologis ditolak. Tanda vital adalah rekam medis
     * append-only: salah ketik yang tersimpan tidak dapat dihapus, hanya
     * dibantah oleh pencatatan berikutnya.
     *
     */
    #[DataProvider('outOfRangeReadings')]
    public function test_it_rejects_physiologically_impossible_readings(string $field, int $value): void
    {
        $user = $this->actingUser();
        Employee::factory()->create(['user_id' => $user->id]);
        $visit = Visit::factory()->create();

        $this->postJson('/api/v1/vital-signs', [
            'visit_id' => $visit->id,
            $field => $value,
        ])->assertStatus(422)->assertJsonValidationErrors($field);
    }

    public static function outOfRangeReadings(): array
    {
        return [
            'nadi 9000' => ['pulse', 9000],
            'sistolik 30000' => ['systolic', 30000],
            'diastolik 5000' => ['diastolic', 5000],
            'laju napas 999' => ['respiratory_rate', 999],
        ];
    }

    /** Nilai wajar tetap diterima -- batasnya tidak boleh terlalu ketat. */
    public function test_it_accepts_readings_at_the_edge_of_plausible(): void
    {
        $user = $this->actingUser();
        Employee::factory()->create(['user_id' => $user->id]);
        $visit = Visit::factory()->create();

        // Takikardia berat pada bayi + hipertensi krisis: ekstrem, tapi nyata.
        $this->postJson('/api/v1/vital-signs', [
            'visit_id' => $visit->id,
            'pulse' => 220,
            'systolic' => 240,
            'diastolic' => 140,
            'temperature' => 41.5,
        ])->assertCreated();
    }
}
