<?php

namespace Modules\BpjsAntreanFktp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\BpjsAntreanFktp\Models\MobileJknToken;

/**
 * Token endpoint (confirmed spec): Mobile JKN calls this with
 * x-username/x-password (credentials BPJS issued to THIS hospital,
 * config('bpjs.families.antrean_fktp.inbound_username'/'inbound_password')),
 * we validate and issue a token it then sends as x-token on every
 * subsequent inbound call.
 */
class MobileJknTokenController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->header('x-username');
        $password = $request->header('x-password');

        $config = config('bpjs.families.antrean_fktp');

        if (
            ! $username || ! $password
            || ! hash_equals((string) ($config['inbound_username'] ?? ''), $username)
            || ! hash_equals((string) ($config['inbound_password'] ?? ''), $password)
        ) {
            return response()->json(['metadata' => ['message' => 'Invalid credentials', 'code' => 401]], 401);
        }

        $plainTextToken = Str::random(60);

        // Prune ala produksi (DELETE token_active kedaluwarsa tiap terbit).
        MobileJknToken::where('expires_at', '<', now())->delete();

        $token = MobileJknToken::create([
            'username' => $username,
            // Only the sha256 digest is persisted; the plaintext token is shown once.
            'token' => hash('sha256', $plainTextToken),
            'expires_at' => now()->addMinutes((int) config('bpjs.mobile_jkn_token_ttl_minutes', 10)),
        ]);

        return response()->json([
            'response' => ['token' => $plainTextToken],
            'metadata' => ['message' => 'Ok', 'code' => 200],
        ]);
    }
}
