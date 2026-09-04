<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;
use Tests\TestCase;

class AntimicrobialStewardshipFormControllerTest extends TestCase
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

    public function test_it_lists_amr_forms(): void
    {
        $this->actingUser();
        AntimicrobialStewardshipForm::factory()->count(3)->create();

        $this->getJson('/api/v1/antimicrobial-stewardship-forms')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_amr_form(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/antimicrobial-stewardship-forms', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'indication' => 'Test description text',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'draft');
        $this->assertDatabaseCount('antimicrobial_stewardship_forms', 1);
    }

    public function test_status_is_ignored_on_create(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/antimicrobial-stewardship-forms', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'indication' => 'Test description text',
            'status' => 'approved',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'draft');
    }

    public function test_it_shows_amr_form(): void
    {
        $this->actingUser();
        $amr_form = AntimicrobialStewardshipForm::factory()->create();

        $this->getJson("/api/v1/antimicrobial-stewardship-forms/{$amr_form->id}")->assertOk()->assertJsonPath('data.id', $amr_form->id);
    }

    public function test_it_transitions_draft_to_submitted(): void
    {
        $this->actingUser();
        $amr_form = AntimicrobialStewardshipForm::factory()->create(['status' => 'draft']);

        $this->putJson("/api/v1/antimicrobial-stewardship-forms/{$amr_form->id}", ['status' => 'submitted'])
            ->assertOk()->assertJsonPath('data.status', 'submitted');

        $this->assertDatabaseHas('antimicrobial_stewardship_forms', ['id' => $amr_form->id, 'status' => 'submitted']);
        $this->assertNotNull($amr_form->fresh()->submitted_at);
    }

    public function test_it_transitions_submitted_to_approved(): void
    {
        $this->actingUser();
        $amr_form = AntimicrobialStewardshipForm::factory()->create(['status' => 'submitted']);

        $this->putJson("/api/v1/antimicrobial-stewardship-forms/{$amr_form->id}", ['status' => 'approved'])
            ->assertOk()->assertJsonPath('data.status', 'approved');
    }

    public function test_it_rejects_skipping_workflow_state(): void
    {
        $this->actingUser();
        $amr_form = AntimicrobialStewardshipForm::factory()->create(['status' => 'draft']);

        $this->putJson("/api/v1/antimicrobial-stewardship-forms/{$amr_form->id}", ['status' => 'approved'])
            ->assertStatus(422);
    }

    public function test_it_rejects_transition_from_terminal_state(): void
    {
        $this->actingUser();
        $amr_form = AntimicrobialStewardshipForm::factory()->create(['status' => 'approved']);

        $this->putJson("/api/v1/antimicrobial-stewardship-forms/{$amr_form->id}", ['status' => 'submitted'])
            ->assertStatus(422);
    }

}
