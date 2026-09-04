<?php

namespace Modules\BerkasKlaimRadiologyClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimRadiologyClaim\Http\Requests\StoreRadiologyClaimRequest;
use Modules\BerkasKlaimRadiologyClaim\Http\Requests\TransitionRadiologyClaimRequest;
use Modules\BerkasKlaimRadiologyClaim\Http\Resources\RadiologyClaimResource;
use Modules\BerkasKlaimRadiologyClaim\Models\RadiologyClaim;
use Modules\BerkasKlaimRadiologyClaim\Services\RadiologyClaimService;

class RadiologyClaimController extends Controller
{
    public function __construct(protected RadiologyClaimService $service) {}

    public function index(Request $request)
    {
        $query = RadiologyClaim::query();

        if ($request->filled('claim_file_id')) {
            $query->where('claim_file_id', $request->integer('claim_file_id'));
        }

        return RadiologyClaimResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyClaimRequest $request)
    {
        $claim = $this->service->create($request->validated());

        return (new RadiologyClaimResource($claim))->response()->setStatusCode(201);
    }

    public function show(RadiologyClaim $radiology_claim): RadiologyClaimResource
    {
        return new RadiologyClaimResource($radiology_claim);
    }

    public function transition(TransitionRadiologyClaimRequest $request, RadiologyClaim $radiology_claim): RadiologyClaimResource
    {
        $claim = $this->service->transition($radiology_claim, $request->validated('status'));

        return new RadiologyClaimResource($claim);
    }
}
