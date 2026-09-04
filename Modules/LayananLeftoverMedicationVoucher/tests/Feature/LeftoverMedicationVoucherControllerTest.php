<?php

namespace Modules\LayananLeftoverMedicationVoucher\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLeftoverMedicationVoucher\Models\LeftoverMedicationVoucher;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Tests\TestCase;

class LeftoverMedicationVoucherControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }
    private function actingUser(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');
    }

    public function test_it_lists_vouchers(): void
    {
        $this->actingUser();
        LeftoverMedicationVoucher::factory()->count(3)->create();

        $this->getJson('/api/v1/leftover-medication-vouchers')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_voucher(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/leftover-medication-vouchers', [
            'voucher_number' => 'Test Voucher_number',
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'status' => 'pending',
            'issued_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('leftover_medication_vouchers', 1);
    }

    public function test_it_shows_voucher(): void
    {
        $this->actingUser();
        $voucher = LeftoverMedicationVoucher::factory()->create();

        $this->getJson("/api/v1/leftover-medication-vouchers/{$voucher->id}")->assertOk()->assertJsonPath('data.id', $voucher->id);
    }

    public function test_redeem_stamps_redeemed_at_from_server(): void
    {
        $this->actingUser();
        $voucher = LeftoverMedicationVoucher::factory()->create(['status' => 'pending', 'redeemed_at' => null]);

        $this->putJson("/api/v1/leftover-medication-vouchers/{$voucher->id}", [
            'status' => 'redeemed',
            'redeemed_at' => '2099-01-01 00:00:00',
        ])->assertOk()->assertJsonPath('data.status', 'redeemed');

        $fresh = $voucher->fresh();
        $this->assertNotNull($fresh->redeemed_at);
        $this->assertNotSame('2099-01-01 00:00:00', $fresh->redeemed_at->toDateTimeString());
    }

    public function test_cannot_reset_redeemed_voucher_back_to_pending(): void
    {
        $this->actingUser();
        $voucher = LeftoverMedicationVoucher::factory()->create(['status' => 'pending']);

        $this->putJson("/api/v1/leftover-medication-vouchers/{$voucher->id}", ['status' => 'redeemed'])
            ->assertOk();

        $this->putJson("/api/v1/leftover-medication-vouchers/{$voucher->id}", ['status' => 'pending'])
            ->assertStatus(422);

        $this->assertSame('redeemed', $voucher->fresh()->status);
    }

    public function test_cannot_redeem_an_already_redeemed_voucher_again(): void
    {
        $this->actingUser();
        $voucher = LeftoverMedicationVoucher::factory()->create(['status' => 'pending']);

        $this->putJson("/api/v1/leftover-medication-vouchers/{$voucher->id}", ['status' => 'redeemed'])
            ->assertOk();

        $this->putJson("/api/v1/leftover-medication-vouchers/{$voucher->id}", ['status' => 'redeemed'])
            ->assertStatus(422);
    }

    public function test_it_transitions_pending_to_expired(): void
    {
        $this->actingUser();
        $voucher = LeftoverMedicationVoucher::factory()->create(['status' => 'pending']);

        $this->putJson("/api/v1/leftover-medication-vouchers/{$voucher->id}", ['status' => 'expired'])
            ->assertOk()
            ->assertJsonPath('data.status', 'expired');
    }

    public function test_it_rejects_create_when_medical_record_is_finalized(): void
    {
        $this->actingUser();
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create();
        MedicalRecordEpisode::create([
            'visit_id' => $visit->id,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);

        $this->postJson('/api/v1/leftover-medication-vouchers', [
            'voucher_number' => 'VCH-FINAL-'.uniqid(),
            'visit_id' => $visit->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'issued_at' => '2026-08-26 08:00:00',
        ])->assertStatus(422);

        $this->assertDatabaseCount('leftover_medication_vouchers', 0);
    }
}
