<?php

namespace Modules\BerkasKlaimPharmacyClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimPharmacyClaim\Http\Requests\StorePharmacyClaimRequest;
use Modules\BerkasKlaimPharmacyClaim\Http\Requests\TransitionPharmacyClaimRequest;
use Modules\BerkasKlaimPharmacyClaim\Http\Resources\PharmacyClaimResource;
use Modules\BerkasKlaimPharmacyClaim\Models\PharmacyClaim;
use Modules\BerkasKlaimPharmacyClaim\Services\PharmacyClaimService;

class PharmacyClaimController extends Controller
{
    public function __construct(protected PharmacyClaimService $service) {}

    public function index(Request $request)
    {
        $query = PharmacyClaim::query();

        if ($request->filled('claim_file_id')) {
            $query->where('claim_file_id', $request->integer('claim_file_id'));
        }

        return PharmacyClaimResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyClaimRequest $request)
    {
        $claim = $this->service->create($request->validated());

        return (new PharmacyClaimResource($claim))->response()->setStatusCode(201);
    }

    public function show(PharmacyClaim $pharmacy_claim): PharmacyClaimResource
    {
        return new PharmacyClaimResource($pharmacy_claim);
    }

    public function transition(TransitionPharmacyClaimRequest $request, PharmacyClaim $pharmacy_claim): PharmacyClaimResource
    {
        $claim = $this->service->transition($pharmacy_claim, $request->validated('status'));

        return new PharmacyClaimResource($claim);
    }
}
