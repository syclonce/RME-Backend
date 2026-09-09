<?php

namespace Modules\PembayaranPatientReceivable\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;
use Tests\TestCase;

class PatientReceivableControllerTest extends TestCase
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

    public function test_it_lists_patient_receivables(): void
    {
        $this->actingUser();
        PatientReceivable::factory()->count(3)->create();

        $this->getJson('/api/v1/patient-receivables')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_patient_receivable_as_outstanding(): void
    {
        $this->actingUser();
        // Piutang dibatasi bagian tagihan yang ditanggung pasien, jadi
        // invoice fixture harus punya nilai yang memadai.
        $invoice = Invoice::factory()->create(['total_amount' => 250000]);
        $patient = Patient::factory()->create();

        $this->postJson('/api/v1/patient-receivables', [
            'invoice_id' => $invoice->id,
            'patient_id' => $patient->id,
            'amount' => 250000,
            'due_date' => now()->addDays(14)->toDateString(),
        ])->assertCreated()->assertJsonPath('data.status', 'outstanding');

        $this->assertDatabaseHas('patient_receivables', ['invoice_id' => $invoice->id, 'patient_id' => $patient->id, 'status' => 'outstanding']);
    }

    public function test_status_cannot_be_injected_at_create(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 250000]);
        $patient = Patient::factory()->create();

        $this->postJson('/api/v1/patient-receivables', [
            'invoice_id' => $invoice->id,
            'patient_id' => $patient->id,
            'amount' => 250000,
            'due_date' => now()->addDays(14)->toDateString(),
            'status' => 'settled',
        ])->assertCreated()->assertJsonPath('data.status', 'outstanding');
    }

    public function test_it_updates_status_to_settled(): void
    {
        $this->actingUser();
        $receivable = PatientReceivable::factory()->create(['status' => 'outstanding']);

        $this->patchJson("/api/v1/patient-receivables/{$receivable->id}/transition", ['status' => 'settled'])
            ->assertOk()
            ->assertJsonPath('data.status', 'settled');
    }

    public function test_it_writes_off_an_outstanding_receivable(): void
    {
        $this->actingUser();
        $receivable = PatientReceivable::factory()->create(['status' => 'outstanding']);

        $this->patchJson("/api/v1/patient-receivables/{$receivable->id}/transition", ['status' => 'written_off'])
            ->assertOk()
            ->assertJsonPath('data.status', 'written_off');
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $receivable = PatientReceivable::factory()->create();

        $this->patchJson("/api/v1/patient-receivables/{$receivable->id}/transition", ['status' => 'invalid'])
            ->assertStatus(422);
    }

    public function test_it_rejects_transitioning_an_already_settled_receivable(): void
    {
        $this->actingUser();
        $receivable = PatientReceivable::factory()->create(['status' => 'settled']);

        $this->patchJson("/api/v1/patient-receivables/{$receivable->id}/transition", ['status' => 'written_off'])
            ->assertStatus(422);
    }

    public function test_it_rejects_creating_a_second_outstanding_receivable_for_the_same_invoice(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 500000]);
        $patient = Patient::factory()->create();

        PatientReceivable::factory()->create([
            'invoice_id' => $invoice->id,
            'patient_id' => $patient->id,
            'amount' => 200000,
            'status' => 'outstanding',
        ]);

        $this->postJson('/api/v1/patient-receivables', [
            'invoice_id' => $invoice->id,
            'patient_id' => $patient->id,
            'amount' => 100000,
            'due_date' => now()->addDays(14)->toDateString(),
        ])->assertStatus(422);
    }

    public function test_it_allows_creating_a_new_receivable_after_previous_one_is_settled(): void
    {
        $this->actingUser();
        $invoice = Invoice::factory()->create(['total_amount' => 500000]);
        $patient = Patient::factory()->create();

        PatientReceivable::factory()->create([
            'invoice_id' => $invoice->id,
            'patient_id' => $patient->id,
            'amount' => 200000,
            'status' => 'settled',
        ]);

        $this->postJson('/api/v1/patient-receivables', [
            'invoice_id' => $invoice->id,
            'patient_id' => $patient->id,
            'amount' => 100000,
            'due_date' => now()->addDays(14)->toDateString(),
        ])->assertCreated()->assertJsonPath('data.status', 'outstanding');
    }

    public function test_guest_cannot_access_patient_receivables(): void
    {
        $this->getJson('/api/v1/patient-receivables')->assertStatus(401);
    }
}
