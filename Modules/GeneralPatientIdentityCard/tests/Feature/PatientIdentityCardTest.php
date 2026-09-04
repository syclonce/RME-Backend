<?php

namespace Modules\GeneralPatientIdentityCard\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralIdentityCardType\Models\IdentityCardType;
use Modules\GeneralPatientIdentityCard\Models\PatientIdentityCard;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientIdentityCardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\RoleAndPermissionSeeder::class);
        // Rute modul ini dilindungi auth:sanctum - semua request test harus
        // terautentikasi, sama seperti pola di GeneralPatientFamilyIdentityCard.
        $user = \Modules\Auth\Models\User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');
    }

    public function test_can_list_patient_identity_cards()
    {
        PatientIdentityCard::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/patientidentitycards');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_patient_identity_card()
    {
        $data = PatientIdentityCard::factory()->make()->toArray();
        $response = $this->postJson('/api/v1/patientidentitycards', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('patient_identity_cards', ['identity_number' => $data['identity_number']]);
    }

    public function test_can_show_patient_identity_card()
    {
        $model = PatientIdentityCard::factory()->create();
        $response = $this->getJson("/api/v1/patientidentitycards/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.identity_number', $model->identity_number);
    }

    public function test_can_update_patient_identity_card()
    {
        $model = PatientIdentityCard::factory()->create();
        $type = IdentityCardType::factory()->create();
        $response = $this->putJson("/api/v1/patientidentitycards/{$model->id}", [
            'patient_id' => $model->patient_id,
            'identity_card_type_id' => $type->id,
            'identity_number' => '1234567890',
            'is_same_as_current_address' => true,
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('patient_identity_cards', [
            'identity_number' => '1234567890',
            'identity_card_type_id' => $type->id,
        ]);
    }

    public function test_can_update_patient_identity_card_with_different_address()
    {
        $model = PatientIdentityCard::factory()->create();
        $type = IdentityCardType::factory()->create();
        $response = $this->putJson("/api/v1/patientidentitycards/{$model->id}", [
            'patient_id' => $model->patient_id,
            'identity_card_type_id' => $type->id,
            'identity_number' => '3201234567890001',
            'address' => 'Jl. Merdeka No. 1',
            'rt' => '001',
            'rw' => '002',
            'postal_code' => '40123',
            'is_same_as_current_address' => false,
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('patient_identity_cards', [
            'identity_number' => '3201234567890001',
            'address' => 'Jl. Merdeka No. 1',
            'is_same_as_current_address' => false,
        ]);
    }

    public function test_can_filter_patient_identity_cards_by_patient_id()
    {
        $target = PatientIdentityCard::factory()->create();
        PatientIdentityCard::factory()->count(2)->create();

        $response = $this->getJson("/api/v1/patientidentitycards?patient_id={$target->patient_id}");
        $response->assertStatus(200)->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.patient_id', $target->patient_id);
    }

    public function test_can_delete_patient_identity_card()
    {
        $model = PatientIdentityCard::factory()->create();
        $response = $this->deleteJson("/api/v1/patientidentitycards/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('patient_identity_cards', ['id' => $model->id]);
    }
}
