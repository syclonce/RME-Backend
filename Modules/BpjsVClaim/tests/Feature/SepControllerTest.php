<?php

namespace Modules\BpjsVClaim\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsVClaim\Models\Sep;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralPatient\Models\Patient;
use Tests\TestCase;

class SepControllerTest extends TestCase
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

    public function test_it_creates_a_sep_igd_and_records_bpjs_success(): void
    {
        Http::fake([
            '*Peserta*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'Ok'],
                'response' => ['peserta' => ['noKartu' => '0001112233445', 'hakKelas' => ['kode' => '3']]],
            ]),
            '*SEP/2.0/insert' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'Ok'],
                'response' => ['sep' => ['noSep' => '0001R0011123V000001']],
            ]),
        ]);

        $this->actingUser();
        $patient = Patient::factory()->create();
        $doctor = Doctor::factory()->create();

        $draft = $this->postJson('/api/v1/seps', [
            'visit_type' => 'igd',
            'patient_id' => $patient->id,
            'no_kartu' => '0001112233445',
            'tgl_sep' => now()->toDateString(),
            'dpjp_doctor_id' => $doctor->id,
            'diagnosa_awal' => 'A00.0',
            'status_kecelakaan' => '0',
        ])->assertCreated()->assertJsonPath('data.local_status', 'draft');

        $sepId = $draft->json('data.id');

        $this->postJson("/api/v1/seps/{$sepId}/verify-peserta")
            ->assertOk()
            ->assertJsonPath('data.participant_class', '3');

        $response = $this->postJson("/api/v1/seps/{$sepId}/publish");

        $response->assertCreated();
        $this->assertSame('success', $response->json('data.local_status'));
        $this->assertSame('0001R0011123V000001', $response->json('data.no_sep'));
        $this->assertDatabaseHas('seps', [
            'no_kartu' => '0001112233445',
            'local_status' => 'success',
        ]);
    }

    public function test_publish_menolak_tanpa_cek_peserta(): void
    {
        $this->actingUser();
        $sep = Sep::factory()->create();

        $this->postJson("/api/v1/seps/{$sep->id}/publish")
            ->assertUnprocessable()
            ->assertJsonPath('message', 'Cek peserta BPJS dulu (POST seps/{id}/verify-peserta) sebelum menerbitkan SEP.');
    }

    public function test_verify_menolak_peserta_tak_aktif_tanpa_fallback_cache(): void
    {
        Http::fake([
            '*Peserta*' => Http::response([
                'metaData' => ['code' => '201', 'message' => 'Peserta tidak aktif'],
            ]),
        ]);

        $this->actingUser();
        $sep = Sep::factory()->create();

        $this->postJson("/api/v1/seps/{$sep->id}/verify-peserta")
            ->assertUnprocessable()
            ->assertJsonPath('message', 'Peserta tidak aktif');
        $this->assertNull($sep->fresh()->participant_class);
    }

    public function test_it_records_bpjs_error_without_a_sep_number(): void
    {
        Http::fake([
            '*Peserta*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'Ok'],
                'response' => ['peserta' => ['noKartu' => '0001112233445', 'hakKelas' => ['kode' => '2']]],
            ]),
            '*SEP/2.0/insert' => Http::response([
                'metaData' => ['code' => '201', 'message' => 'Gagal insert SEP'],
            ]),
        ]);

        $this->actingUser();
        $patient = Patient::factory()->create();
        $doctor = Doctor::factory()->create();

        $sepId = $this->postJson('/api/v1/seps', [
            'visit_type' => 'igd',
            'patient_id' => $patient->id,
            'no_kartu' => '0001112233445',
            'tgl_sep' => now()->toDateString(),
            'dpjp_doctor_id' => $doctor->id,
            'diagnosa_awal' => 'A00.0',
            'status_kecelakaan' => '0',
        ])->assertCreated()->json('data.id');

        $this->postJson("/api/v1/seps/{$sepId}/verify-peserta")->assertOk();

        $response = $this->postJson("/api/v1/seps/{$sepId}/publish");

        $response->assertCreated();
        $this->assertSame('error', $response->json('data.local_status'));
        $this->assertSame('Gagal insert SEP', $response->json('data.error_message'));
        $this->assertNull($response->json('data.no_sep'));
    }

    public function test_rujukan_lanjutan_requires_no_rujukan_and_poli(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/seps', [
            'visit_type' => 'rujukan_lanjutan',
            'patient_id' => $patient->id,
            'no_kartu' => '0001112233445',
            'tgl_sep' => now()->toDateString(),
            'status_kecelakaan' => '0',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['no_rujukan', 'poli_tujuan']);
    }

    public function test_accident_status_requires_region_codes(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/seps', [
            'visit_type' => 'igd',
            'patient_id' => $patient->id,
            'no_kartu' => '0001112233445',
            'tgl_sep' => now()->toDateString(),
            'dpjp_doctor_id' => $doctor->id,
            'diagnosa_awal' => 'A00.0',
            'status_kecelakaan' => '1',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors([
            'kecelakaan_provinsi_code', 'kecelakaan_kabupaten_code', 'kecelakaan_kecamatan_code',
        ]);
    }

    public function test_delete_marks_local_status_deleted_on_bpjs_success(): void
    {
        Http::fake(['*' => Http::response(['metaData' => ['code' => '200', 'message' => 'Ok']])]);

        $this->actingUser();
        $sep = Sep::factory()->create(['no_sep' => '0001R0011123V000001', 'local_status' => 'success']);

        $response = $this->deleteJson("/api/v1/seps/{$sep->id}");

        $response->assertOk();
        $this->assertSame('deleted', $sep->fresh()->local_status);
    }

    public function test_delete_keeps_record_when_bpjs_rejects(): void
    {
        Http::fake(['*' => Http::response(['metaData' => ['code' => '201', 'message' => 'SEP sudah diverifikasi']])]);

        $this->actingUser();
        $sep = Sep::factory()->create(['no_sep' => '0001R0011123V000001', 'local_status' => 'success']);

        $response = $this->deleteJson("/api/v1/seps/{$sep->id}");

        $response->assertStatus(422);
        $this->assertSame('success', $sep->fresh()->local_status);
        $this->assertSame('SEP sudah diverifikasi', $sep->fresh()->error_message);
    }

    public function test_guest_cannot_access_seps(): void
    {
        $this->getJson('/api/v1/seps')->assertStatus(401);
    }
}
