<?php

namespace Modules\BpjsVClaim\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;
use Tests\TestCase;

class SepDraftFromRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');
    }

    private function bpjsRegistration(): Registration
    {
        $registration = Registration::factory()->create();
        Guarantor::factory()->create([
            'registration_id' => $registration->id,
            'payer_type' => 'bpjs',
            'member_number' => '0001234567890',
        ]);

        return $registration;
    }

    public function test_draft_is_derived_from_registration_data(): void
    {
        $registration = $this->bpjsRegistration();
        $ward = Ward::factory()->create();
        VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => $ward->id,
        ]);

        $this->postJson('/api/v1/seps/from-registration', [
            'registration_id' => $registration->id,
        ])->assertCreated();

        $this->assertDatabaseHas('seps', [
            'registration_id' => $registration->id,
            'patient_id' => $registration->patient_id,
            'no_kartu' => '0001234567890',
            'poli_tujuan' => (string) $ward->id,
            'local_status' => 'draft',
        ]);
    }

    /** SEP hanya untuk peserta BPJS — pasien umum tidak pernah punya SEP. */
    public function test_registration_without_bpjs_guarantor_is_rejected(): void
    {
        $registration = Registration::factory()->create();
        Guarantor::factory()->create([
            'registration_id' => $registration->id,
            'payer_type' => 'self_pay',
        ]);

        $this->postJson('/api/v1/seps/from-registration', [
            'registration_id' => $registration->id,
        ])->assertStatus(422);

        $this->assertDatabaseMissing('seps', ['registration_id' => $registration->id]);
    }

    /** Satu pendaftaran satu SEP — SEP ganda akan ditolak BPJS saat klaim. */
    public function test_duplicate_sep_for_same_registration_is_rejected(): void
    {
        $registration = $this->bpjsRegistration();

        $this->postJson('/api/v1/seps/from-registration', ['registration_id' => $registration->id])->assertCreated();
        $this->postJson('/api/v1/seps/from-registration', ['registration_id' => $registration->id])->assertStatus(422);
    }
}
