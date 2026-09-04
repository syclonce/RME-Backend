<?php

namespace Modules\EKlaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;
use Modules\EKlaim\Services\ClaimSubmissionOrchestrator;
use Modules\EKlaim\Models\EklaimCall;
use Modules\EKlaim\Services\EklaimService;

class EKlaimController extends Controller
{
    public function __construct(private readonly EklaimService $service)
    {
    }

    public function index(Request $request)
    {
        $query = EklaimCall::query();
        if ($request->filled('method')) {
            $query->where('method', $request->string('method'));
        }

        return $query->latest()->paginate($request->integer('per_page', 15));
    }

    public function show(EklaimCall $eklaimCall)
    {
        return $eklaimCall;
    }

    /**
     * Generic ws.php RPC passthrough - client supplies the `metadata.method`
     * value directly, letting callers reach any of the ~30 confirmed manual
     * methods (or an unconfirmed legacy one, once verified) without a
     * dedicated route per operation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'method' => ['required', 'string'],
            'data' => ['nullable', 'array'],
        ]);

        $call = $this->service->call($validated['method'], $validated['data'] ?? []);

        return response()->json($call)->setStatusCode(201);
    }

    /**
     * Ajukan satu klaim internal lewat rangkaian 7 langkah E-Klaim.
     *
     * Endpoint tersendiri dari `store()` yang generik: yang ini menjalankan URUTAN
     * yang benar, sedangkan `store()` membiarkan klien memanggil method apa pun
     * satu per satu.
     */
    public function submitClaim(Request $request, ClaimInvoice $claim, ClaimSubmissionOrchestrator $orchestrator)
    {
        $validated = $request->validate([
            'data' => ['required', 'array'],
        ]);

        $results = $orchestrator->submit($claim, $validated['data']);

        return response()->json([
            'claim' => $claim->refresh(),
            'steps' => $results,
        ]);
    }
}
