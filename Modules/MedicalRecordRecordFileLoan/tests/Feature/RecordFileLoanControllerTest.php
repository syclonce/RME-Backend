<?php

namespace Modules\MedicalRecordRecordFileLoan\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordRecordFileLoan\Models\RecordFileLoan;
use Tests\TestCase;

class RecordFileLoanControllerTest extends TestCase
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

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();

        $payload = [
            'patient_id' => 1,
            'borrower_name' => 'Dr. Ahmad Setiawan',
            'loaned_at' => now()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/v1/record-file-loans', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.borrower_name', 'Dr. Ahmad Setiawan');
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        RecordFileLoan::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/record-file-loans');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create();

        $response = $this->getJson("/api/v1/record-file-loans/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create();

        $response = $this->putJson("/api/v1/record-file-loans/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create();

        $response = $this->deleteJson("/api/v1/record-file-loans/{$record->id}");

        $response->assertNoContent();
    }

    public function test_status_cannot_be_injected_on_create(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/record-file-loans', [
            'patient_id' => 1,
            'borrower_name' => 'Dr. Ahmad Setiawan',
            'loaned_at' => now()->toDateTimeString(),
            'status' => 'returned',
        ]);

        $response->assertCreated();
        $this->assertSame('borrowed', $response->json('data.status'));
    }

    public function test_it_transitions_borrowed_to_returned(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create(['status' => 'borrowed']);

        $this->patchJson("/api/v1/record-file-loans/{$record->id}/status", ['status' => 'returned'])
            ->assertOk()
            ->assertJsonPath('data.status', 'returned');

        $this->assertNotNull($record->fresh()->returned_at);
    }

    public function test_it_transitions_overdue_to_returned(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create(['status' => 'overdue']);

        $this->patchJson("/api/v1/record-file-loans/{$record->id}/status", ['status' => 'returned'])
            ->assertOk()
            ->assertJsonPath('data.status', 'returned');
    }

    public function test_it_rejects_transition_from_returned(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create(['status' => 'returned']);

        $this->patchJson("/api/v1/record-file-loans/{$record->id}/status", ['status' => 'overdue'])
            ->assertStatus(422);
    }

    public function test_update_cannot_change_status(): void
    {
        $this->actingUser();
        $record = RecordFileLoan::factory()->create(['status' => 'borrowed']);

        $this->putJson("/api/v1/record-file-loans/{$record->id}", [
            'borrower_name' => 'Dr. Baru',
            'status' => 'returned',
        ])->assertOk();

        $this->assertSame('borrowed', $record->fresh()->status);
        $this->assertSame('Dr. Baru', $record->fresh()->borrower_name);
    }
}
