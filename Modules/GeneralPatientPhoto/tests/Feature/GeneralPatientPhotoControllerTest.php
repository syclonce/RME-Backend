<?php

namespace Modules\GeneralPatientPhoto\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientPhoto\Models\PatientPhoto;
use Tests\TestCase;

class GeneralPatientPhotoControllerTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
        Storage::fake('public');
    }
    private function actingUser(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');
    }

    /**
     * UploadedFile::fake()->image() needs the GD extension (not installed on
     * this box) to render pixels. The `image` validation rule only reads
     * dimensions via getimagesize(), so a minimal real 1x1 JPEG is enough.
     */
    private function fakeJpeg(string $name): UploadedFile
    {
        $jpeg = base64_decode('/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD/wAARCAABAAEDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAj/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAX/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwCdABmX/9k=');
        $path = tempnam(sys_get_temp_dir(), 'test').'.jpg';
        file_put_contents($path, $jpeg);

        return new UploadedFile($path, $name, 'image/jpeg', null, true);
    }

    public function test_it_creates_patient_photo(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->post('/api/v1/patient-photos', [
            'patient_id' => $patient->id,
            'photo' => $this->fakeJpeg('baru.jpg'),
            'taken_at' => now()->toIso8601String(),
        ])
            ->assertCreated();

        $filePath = $response->json('file_path');
        Storage::disk('public')->assertExists($filePath);
    }

    public function test_it_lists_photos_filtered_by_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        PatientPhoto::factory()->count(2)->create(['patient_id' => $patient->id]);
        PatientPhoto::factory()->create();

        $this->getJson("/api/v1/patient-photos?patient_id={$patient->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patient-photos', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['patient_id', 'photo']);
    }

    public function test_it_updates_patient_photo(): void
    {
        $this->actingUser();
        $photo = PatientPhoto::factory()->create(['file_path' => 'patient-photos/old.jpg']);

        $response = $this->put("/api/v1/patient-photos/{$photo->id}", [
            'photo' => $this->fakeJpeg('baru.jpg'),
        ])
            ->assertOk();

        $filePath = $response->json('file_path');
        $this->assertNotSame('patient-photos/old.jpg', $filePath);
        Storage::disk('public')->assertExists($filePath);
    }

    public function test_it_deletes_patient_photo(): void
    {
        $this->actingUser();
        $photo = PatientPhoto::factory()->create();

        $this->deleteJson("/api/v1/patient-photos/{$photo->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('patient_photos', ['id' => $photo->id]);
    }
}
