<?php

namespace Modules\BpjsAntreanRs\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\BpjsAntreanRs\Models\MobileJknToken;

/**
 * Guards inbound WS RS routes called by BPJS's Mobile JKN app. Mobile JKN's
 * own auth scheme (x-token/x-username, issued by the Token endpoint) is
 * separate from this app's auth:sanctum and from BpjsSignature (which only
 * signs OUTBOUND calls this hospital makes to BPJS).
 */
class VerifyBpjsMobileJknToken
{
    public function handle(Request $request, Closure $next)
    {
        $username = $request->header('x-username');
        $token = $request->header('x-token');

        if (! $token) {
            return response()->json(['metadata' => ['message' => 'x-token required', 'code' => 401]], 401);
        }

        // Stored tokens are sha256 digests; hash the presented token before lookup.
        // x-username OPSIONAL (paritas produksi RSUD Ciamis yang hanya memeriksa
        // x-token): bila dikirim, harus cocok dengan pemilik token; bila tidak
        // dikirim, token bearer saja cukup. Ini mencegah 401 palsu terhadap
        // panggilan Mobile JKN asli yang tidak menyertakan username.
        $query = MobileJknToken::where('token', hash('sha256', $token));

        if ($username) {
            $query->where('username', $username);
        }

        $record = $query->first();

        if (! $record || $record->isExpired()) {
            return response()->json(['metadata' => ['message' => 'Invalid or expired token', 'code' => 401]], 401);
        }

        return $next($request);
    }
}
