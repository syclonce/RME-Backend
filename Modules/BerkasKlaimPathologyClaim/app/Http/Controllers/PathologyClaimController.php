<?php

namespace Modules\BerkasKlaimPathologyClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimPathologyClaim\Http\Requests\StorePathologyClaimRequest;
use Modules\BerkasKlaimPathologyClaim\Http\Requests\TransitionPathologyClaimRequest;
use Modules\BerkasKlaimPathologyClaim\Http\Resources\PathologyClaimResource;
use Modules\BerkasKlaimPathologyClaim\Models\PathologyClaim;
use Modules\BerkasKlaimPathologyClaim\Services\PathologyClaimService;

class PathologyClaimController extends Controller
{
    public function __construct(protected PathologyClaimService $service) {}

    public function index(Request $request)
    {
        $query = PathologyClaim::query();

        if ($request->filled('claim_file_id')) {
            $query->where('claim_file_id', $request->integer('claim_file_id'));
        }

        return PathologyClaimResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePathologyClaimRequest $request)
    {
        $claim = $this->service->create($request->validated());

        return (new PathologyClaimResource($claim))->response()->setStatusCode(201);
    }

    public function show(PathologyClaim $pathology_claim): PathologyClaimResource
    {
        return new PathologyClaimResource($pathology_claim);
    }

    public function transition(TransitionPathologyClaimRequest $request, PathologyClaim $pathology_claim): PathologyClaimResource
    {
        $claim = $this->service->transition($pathology_claim, $request->validated('status'));

        return new PathologyClaimResource($claim);
    }
}
