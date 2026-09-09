<?php

namespace Modules\InventoryStockOpname\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryStockOpname\Http\Requests\StoreStockOpnameRequest;
use Modules\InventoryStockOpname\Http\Requests\UpdateStockOpnameRequest;
use Modules\InventoryStockOpname\Http\Resources\StockOpnameResource;
use Modules\InventoryStockOpname\Models\StockOpname;
use Modules\InventoryStockOpname\Services\StockOpnameService;

class InventoryStockOpnameController extends Controller
{
    public function index(Request $request)
    {
        $query = StockOpname::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return StockOpnameResource::collection($query->latest('opname_date')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreStockOpnameRequest $request, StockOpnameService $service)
    {
        $opname = $service->create($request->validated());

        return (new StockOpnameResource($opname))->response()->setStatusCode(201);
    }

    public function show(StockOpname $inventorystockopname): StockOpnameResource
    {
        return new StockOpnameResource($inventorystockopname);
    }

    public function update(UpdateStockOpnameRequest $request, StockOpname $inventorystockopname, StockOpnameService $service): StockOpnameResource
    {
        $opname = $service->transition($inventorystockopname, $request->validated('status'));

        if ($request->filled('notes')) {
            $opname->update(['notes' => $request->validated('notes')]);
        }

        return new StockOpnameResource($opname);
    }
}
