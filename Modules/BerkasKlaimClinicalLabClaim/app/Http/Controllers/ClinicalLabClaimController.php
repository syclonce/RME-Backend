<?php

namespace Modules\BerkasKlaimClinicalLabClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BerkasKlaimClinicalLabClaim\Http\Requests\StoreClinicalLabClaimRequest;
use Modules\BerkasKlaimClinicalLabClaim\Http\Requests\TransitionClinicalLabClaimRequest;
use Modules\BerkasKlaimClinicalLabClaim\Http\Resources\ClinicalLabClaimResource;
use Modules\BerkasKlaimClinicalLabClaim\Models\ClinicalLabClaim;
use Modules\BerkasKlaimClinicalLabClaim\Services\ClinicalLabClaimService;

class ClinicalLabClaimController extends Controller
{
    public function __construct(protected ClinicalLabClaimService $service) {}

    public function index(Request $request)
    {
        $query = ClinicalLabClaim::query();

        if ($request->filled('claim_file_id')) {
            $query->where('claim_file_id', $request->integer('claim_file_id'));
        }

        return ClinicalLabClaimResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreClinicalLabClaimRequest $request)
    {
        $claim = $this->service->create($request->validated());

        return (new ClinicalLabClaimResource($claim))->response()->setStatusCode(201);
    }

    public function show(ClinicalLabClaim $clinical_lab_claim): ClinicalLabClaimResource
    {
        return new ClinicalLabClaimResource($clinical_lab_claim);
    }

    public function transition(TransitionClinicalLabClaimRequest $request, ClinicalLabClaim $clinical_lab_claim): ClinicalLabClaimResource
    {
        $claim = $this->service->transition($clinical_lab_claim, $request->validated('status'));

        return new ClinicalLabClaimResource($claim);
    }
}
