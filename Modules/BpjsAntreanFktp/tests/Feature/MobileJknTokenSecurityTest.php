<?php

namespace Modules\BpjsAntreanFktp\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Modules\BpjsAntreanFktp\Http\Middleware\VerifyBpjsMobileJknToken;
use Modules\BpjsAntreanFktp\Models\MobileJknToken;
use Tests\TestCase;

/**
 * Regression for security findings S-1/S-2: token endpoint must compare
 * credentials timing-safely, be rate limited, and persist tokens only as
 * sha256 digests that the VerifyBpjsMobileJknToken middleware can still
 * authenticate end-to-end (generate -> store -> verify).
 */
class MobileJknTokenSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'bpjs.families.antrean_fktp.inbound_username' => 'rsuser',
            'bpjs.families.antrean_fktp.inbound_password' => 'rspass',
        ]);
    }

    public function test_wrong_password_is_rejected_with_401(): void
    {
        $this->withHeaders(['x-username' => 'rsuser', 'x-password' => 'wrong'])
            ->getJson('/api/v1/antrean-fktp/mobile-jkn/token')
            ->assertStatus(401)
            ->assertJsonPath('metadata.code', 401);

        $this->assertDatabaseCount('antrean_fktp_mobile_jkn_tokens', 0);
    }

    public function test_correct_credentials_issue_token_stored_as_sha256_digest(): void
    {
        $response = $this->withHeaders(['x-username' => 'rsuser', 'x-password' => 'rspass'])
            ->getJson('/api/v1/antrean-fktp/mobile-jkn/token');

        $response->assertOk()->assertJsonPath('metadata.code', 200);

        $plainText = $response->json('response.token');
        $this->assertNotEmpty($plainText);

        // Plaintext never lands in the database, only its sha256 digest.
        $this->assertDatabaseMissing('antrean_fktp_mobile_jkn_tokens', ['token' => $plainText]);
        $record = MobileJknToken::where('username', 'rsuser')->first();
        $this->assertNotNull($record);
        $this->assertSame(hash('sha256', $plainText), $record->token);
        $this->assertFalse($record->isExpired());
    }

    public function test_token_endpoint_is_rate_limited(): void
    {
        $headers = ['x-username' => 'rsuser', 'x-password' => 'rspass'];
        $route = '/api/v1/antrean-fktp/mobile-jkn/token';

        foreach (range(1, 30) as $attempt) {
            $this->withHeaders($headers)->getJson($route)->assertStatus(200);
        }

        $this->withHeaders($headers)
            ->getJson($route)
            ->assertStatus(429);
    }

    public function test_issued_token_passes_jkn_middleware_and_survives_reuse(): void
    {
        Route::middleware([VerifyBpjsMobileJknToken::class])
            ->get('/_jkn-guarded-dummy', fn () => response()->json(['ok' => true]));

        $plainText = $this->withHeaders(['x-username' => 'rsuser', 'x-password' => 'rspass'])
            ->getJson('/api/v1/antrean-fktp/mobile-jkn/token')
            ->json('response.token');

        $guardHeaders = ['x-username' => 'rsuser', 'x-token' => $plainText];

        // First call authenticates against the stored digest...
        $this->withHeaders($guardHeaders)
            ->getJson('/_jkn-guarded-dummy')
            ->assertOk()
            ->assertJson(['ok' => true]);

        // ...and the same plaintext token keeps working on later calls.
        $this->withHeaders($guardHeaders)
            ->getJson('/_jkn-guarded-dummy')
            ->assertOk();

        // A forged value that is not a known digest stays rejected.
        $this->withHeaders(['x-username' => 'rsuser', 'x-token' => str_repeat('a', 60)])
            ->getJson('/_jkn-guarded-dummy')
            ->assertStatus(401);
    }

    public function test_token_berumur_10_menit_dan_prune_saat_terbit(): void
    {
        MobileJknToken::create([
            'username' => 'rsuser',
            'token' => hash('sha256', 'basi'),
            'expires_at' => now()->subHour(),
        ]);

        $plainText = $this->withHeaders(['x-username' => 'rsuser', 'x-password' => 'rspass'])
            ->getJson('/api/v1/antrean-fktp/mobile-jkn/token')
            ->assertOk()
            ->json('response.token');

        $record = MobileJknToken::where('username', 'rsuser')->first();
        $this->assertEqualsWithDelta(
            now()->addMinutes(10)->getTimestamp(),
            $record->expires_at->getTimestamp(),
            120
        );
        $this->assertDatabaseMissing('antrean_fktp_mobile_jkn_tokens', ['token' => hash('sha256', 'basi')]);
        $this->assertSame(hash('sha256', $plainText), $record->token);
    }

    public function test_token_saja_cukup_tanpa_username(): void
    {
        Route::middleware([VerifyBpjsMobileJknToken::class])
            ->get('/_jkn-no-username-fktp', fn () => response()->json(['ok' => true]));

        $plainText = $this->withHeaders(['x-username' => 'rsuser', 'x-password' => 'rspass'])
            ->getJson('/api/v1/antrean-fktp/mobile-jkn/token')
            ->json('response.token');

        $this->withHeaders(['x-token' => $plainText])
            ->getJson('/_jkn-no-username-fktp')
            ->assertOk();

        $this->withHeaders(['x-username' => 'orang-lain', 'x-token' => $plainText])
            ->getJson('/_jkn-no-username-fktp')
            ->assertStatus(401);
    }
}
