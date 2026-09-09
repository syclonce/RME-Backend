<?php

namespace Modules\SatuSehat\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\SatuSehat\Console\Commands\RetrySatuSehatSubmissions;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Tests\TestCase;

class RetrySatuSehatSubmissionsTest extends TestCase
{
    use RefreshDatabase;

    private function fakeToken(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'abc123', 'expires_in' => 3600]),
        ]);
    }

    public function test_retry_mengirim_pending_dan_menandai_sent(): void
    {
        $this->fakeToken();
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'abc123', 'expires_in' => 3600]),
            '*/Encounter' => Http::response(['id' => 'satusehat-1']),
        ]);
        $submission = SatuSehatStagingSubmission::factory()->create(['status' => 'pending', 'attempts' => 0]);

        $this->artisan('satusehat:retry-submissions')->assertSuccessful();

        $this->assertSame('sent', $submission->fresh()->status);
        $this->assertSame('satusehat-1', $submission->fresh()->satusehat_id);
    }

    public function test_gagal_tetap_di_antrean_tidak_pernah_ditandai_sent(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'abc123', 'expires_in' => 3600]),
            '*/Encounter' => Http::response(['issue' => 'invalid'], 400),
        ]);
        $submission = SatuSehatStagingSubmission::factory()->create(['status' => 'pending', 'attempts' => 0]);

        $this->artisan('satusehat:retry-submissions')->assertSuccessful();

        // Kebalikan cacat legacy (statusRequest=0 di semua cabang gagal):
        // gagal = tetap failed + attempts++ + last_error, bukan hilang.
        $fresh = $submission->fresh();
        $this->assertSame('failed', $fresh->status);
        $this->assertSame(1, $fresh->attempts);
        $this->assertNotNull($fresh->last_error);
    }

    public function test_melewati_batas_masuk_dead_letter(): void
    {
        $this->fakeToken();
        $submission = SatuSehatStagingSubmission::factory()->create([
            'status' => 'failed',
            'attempts' => RetrySatuSehatSubmissions::MAX_ATTEMPTS,
            'updated_at' => now()->subDays(2),
        ]);

        $this->artisan('satusehat:retry-submissions')->assertSuccessful();

        $this->assertSame('dead', $submission->fresh()->status);
        Http::assertSentCount(0);
    }

    public function test_backoff_menahan_barusan_gagal(): void
    {
        $this->fakeToken();
        $submission = SatuSehatStagingSubmission::factory()->create([
            'status' => 'failed',
            'attempts' => 1,
            'updated_at' => now(),
        ]);

        $this->artisan('satusehat:retry-submissions')->assertSuccessful();

        // attempts=1 → jeda 300 dtk; baru gagal sedetik lalu = dilewati.
        $this->assertSame(1, $submission->fresh()->attempts);
        Http::assertSentCount(0);
    }

    public function test_limit_membatasi_per_jalan(): void
    {
        $this->fakeToken();
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'abc123', 'expires_in' => 3600]),
            '*/Encounter' => Http::response(['id' => 'x']),
        ]);
        SatuSehatStagingSubmission::factory()->count(3)->create(['status' => 'pending', 'attempts' => 0]);

        $this->artisan('satusehat:retry-submissions', ['--limit' => 2])->assertSuccessful();

        $this->assertSame(2, SatuSehatStagingSubmission::where('status', 'sent')->count());
        $this->assertSame(1, SatuSehatStagingSubmission::where('status', 'pending')->count());
    }
}
