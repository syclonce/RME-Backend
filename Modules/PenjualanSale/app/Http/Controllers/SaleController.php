<?php

namespace Modules\PenjualanSale\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PenjualanSale\Http\Requests\StoreSaleRequest;
use Modules\PenjualanSale\Http\Requests\UpdateSaleRequest;
use Modules\PenjualanSale\Http\Resources\SaleResource;
use Modules\PenjualanSale\Models\Sale;
use Modules\PenjualanSale\Services\SaleService;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return SaleResource::collection($query->latest('sold_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSaleRequest $request, SaleService $service)
    {
        $sale = $service->create($request->validated());

        return (new SaleResource($sale))->response()->setStatusCode(201);
    }

    public function show(Sale $sale): SaleResource
    {
        return new SaleResource($sale);
    }

    public function update(UpdateSaleRequest $request, Sale $sale, SaleService $service): SaleResource
    {
        return new SaleResource($service->transition($sale, $request->validated('status')));
    }
}
