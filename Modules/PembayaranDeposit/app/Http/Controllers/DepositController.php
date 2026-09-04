<?php

namespace Modules\PembayaranDeposit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranDeposit\Http\Requests\StoreDepositRequest;
use Modules\PembayaranDeposit\Http\Requests\UpdateDepositRequest;
use Modules\PembayaranDeposit\Http\Resources\DepositResource;
use Modules\PembayaranDeposit\Models\Deposit;
use Modules\PembayaranDeposit\Services\DepositService;

class DepositController extends Controller
{
    public function index(Request $request)
    {
        $query = Deposit::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DepositResource::collection($query->latest('paid_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Deposits are financial records - amount/visit are append-only. Only the
     * status transitions (held -> applied/refunded).
     */
    public function store(StoreDepositRequest $request, DepositService $service)
    {
        $deposit = $service->create($request->validated(), $request->user());

        return (new DepositResource($deposit))->response()->setStatusCode(201);
    }

    public function show(Deposit $deposit): DepositResource
    {
        return new DepositResource($deposit);
    }

    public function update(UpdateDepositRequest $request, Deposit $deposit, DepositService $service): DepositResource
    {
        return new DepositResource($service->transition($deposit, $request->validated('status')));
    }
}
