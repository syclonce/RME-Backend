<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class IntegrationHealthCheckTest extends TestCase
{
    use RefreshDatabase;

    private function fullConfig(): void
    {
        config([
            'bpjs.timezone' => 'Asia/Jakarta',
            'bpjs.signature_add_time' => 'PT0S',
            'bpjs.families' => [
                'vclaim' => [
                    'base_url' => 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev',
                    'cons_id' => '12345',
                    'secret_key' => 'rahasia',
                    'user_key' => 'kunci-user',
                ],
            ],
            'eklaim.base_url' => 'http://eklaim.local',
            'eklaim.key' => str_repeat('ab', 32),
            'satusehat.auth_url' => 'https://api-satusehat-stg.kemkes.go.id/oauth2/v1',
            'satusehat.base_url' => 'https://api-satusehat-stg.kemkes.go.id/fhir-r4/v1',
            'satusehat.client_id' => 'cid',
            'satusehat.client_secret' => 'csecret',
            'satusehat.organization_id' => 'org-1',
        ]);
    }

    public function test_sehat_tanpa_jaringan_bila_kredensial_lengkap(): void
    {
        $this->fullConfig();

        $this->artisan('integrations:health')->assertSuccessful();

        Http::assertNothingSent();
    }

    public function test_gagal_bila_kredensial_kosong(): void
    {
        config(['bpjs.families' => [], 'eklaim.base_url' => null, 'eklaim.key' => null]);

        $this->artisan('integrations:health')->assertFailed();
    }

    public function test_gagal_bila_format_kunci_eklaim_salah(): void
    {
        $this->fullConfig();
        config(['eklaim.key' => 'bukan-hex-64']);

        $this->artisan('integrations:health')->assertFailed();
    }

    public function test_ping_mencatat_unreachable_eksplisit(): void
    {
        $this->fullConfig();
        Http::fake(fn () => throw new \Illuminate\Http\Client\ConnectionException('timeout'));

        $this->artisan('integrations:health', ['--ping' => true, '--json' => true])
            ->assertFailed();
    }

    public function test_json_memuat_bentuk_barisan_layanan(): void
    {
        $this->fullConfig();

        $this->artisan('integrations:health', ['--json' => true])
            ->expectsOutputToContain('bpjs.vclaim')
            ->expectsOutputToContain('eklaim')
            ->expectsOutputToContain('satusehat')
            ->assertSuccessful();
    }
}
