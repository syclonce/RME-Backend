<?php

namespace Modules\InventoryStockRequest\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryStockRequest\Http\Requests\FulfillStockRequestRequest;
use Modules\InventoryStockRequest\Http\Requests\StoreStockRequestRequest;
use Modules\InventoryStockRequest\Http\Resources\StockRequestResource;
use Modules\InventoryStockRequest\Models\StockRequest;
use Modules\InventoryStockRequest\Services\StockRequestService;

class StockRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = StockRequest::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return StockRequestResource::collection($query->latest('requested_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreStockRequestRequest $request, StockRequestService $service)
    {
        $stockRequest = $service->create($request->validated(), $request->user());

        return (new StockRequestResource($stockRequest))->response()->setStatusCode(201);
    }

    public function show(StockRequest $stock_request): StockRequestResource
    {
        return new StockRequestResource($stock_request);
    }

    public function update(FulfillStockRequestRequest $request, StockRequest $stock_request, StockRequestService $service): StockRequestResource
    {
        return new StockRequestResource($service->transition($stock_request, $request->validated('status')));
    }
}
