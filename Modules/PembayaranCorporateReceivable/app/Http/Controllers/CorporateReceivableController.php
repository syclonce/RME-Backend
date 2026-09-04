<?php

namespace Modules\PembayaranCorporateReceivable\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranCorporateReceivable\Http\Requests\StoreCorporateReceivableRequest;
use Modules\PembayaranCorporateReceivable\Http\Requests\TransitionCorporateReceivableRequest;
use Modules\PembayaranCorporateReceivable\Http\Resources\CorporateReceivableResource;
use Modules\PembayaranCorporateReceivable\Models\CorporateReceivable;
use Modules\PembayaranCorporateReceivable\Services\CorporateReceivableService;

class CorporateReceivableController extends Controller
{
    public function __construct(protected CorporateReceivableService $service) {}

    public function index(Request $request)
    {
        $query = CorporateReceivable::query();

        if ($request->filled('guarantor_id')) {
            $query->where('guarantor_id', $request->integer('guarantor_id'));
        }

        return CorporateReceivableResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreCorporateReceivableRequest $request)
    {
        $receivable = $this->service->create($request->validated());

        return (new CorporateReceivableResource($receivable))->response()->setStatusCode(201);
    }

    public function show(CorporateReceivable $corporate_receivable): CorporateReceivableResource
    {
        return new CorporateReceivableResource($corporate_receivable);
    }

    public function transition(TransitionCorporateReceivableRequest $request, CorporateReceivable $corporate_receivable): CorporateReceivableResource
    {
        $receivable = $this->service->transition($corporate_receivable, $request->validated('status'));

        return new CorporateReceivableResource($receivable);
    }
}
