<?php

namespace Tests\Feature\Support;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;
use Tests\TestCase;

/**
 * Ditemukan lewat pemanggilan HTTP sungguhan ke server dev, bukan lewat tes:
 * POST /api/v1/visits mengembalikan "status": null padahal di database sudah
 * 'active'. Tes lama tidak menangkapnya karena memeriksa isi database
 * (assertDatabaseHas), dan database memang benar sejak awal -- yang salah
 * hanya badan responsnya.
 *
 * Akibatnya nyata di klien: layar yang menyaring "kunjungan aktif" tidak dapat
 * membedakan kunjungan baru dari yang batal.
 */
class HydratesDatabaseDefaultsTest extends TestCase
{
    use RefreshDatabase;

    public function test_visit_status_is_present_right_after_create(): void
    {
        $visit = Visit::factory()->create();

        // TANPA refresh() -- inilah yang dikembalikan controller ke klien.
        $this->assertSame('active', $visit->status);
    }

    public function test_registration_status_is_present_right_after_create(): void
    {
        $this->assertSame('active', Registration::factory()->create()->status);
    }

    public function test_visit_destination_status_is_present_right_after_create(): void
    {
        $registration = Registration::factory()->create();

        $destination = VisitDestination::create([
            'registration_id' => $registration->id,
            'ward_id' => $registration->visits()->first()?->ward_id
                ?? \Modules\GeneralWard\Models\Ward::factory()->create()->id,
        ]);

        $this->assertSame('pending', $destination->status);
    }

    /**
     * Model yang statusnya dikirim eksplisit tidak boleh ditimpa nilai default.
     */
    public function test_explicit_status_is_not_overwritten(): void
    {
        $visit = Visit::factory()->create(['status' => 'discharged']);

        $this->assertSame('discharged', $visit->status);
    }
}
