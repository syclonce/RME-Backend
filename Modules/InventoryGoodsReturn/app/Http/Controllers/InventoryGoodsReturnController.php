<?php

namespace Modules\InventoryGoodsReturn\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryGoodsReturn\Http\Requests\StoreGoodsReturnRequest;
use Modules\InventoryGoodsReturn\Http\Requests\UpdateGoodsReturnRequest;
use Modules\InventoryGoodsReturn\Http\Resources\GoodsReturnResource;
use Modules\InventoryGoodsReturn\Models\GoodsReturn;
use Modules\InventoryGoodsReturn\Services\GoodsReturnService;

class InventoryGoodsReturnController extends Controller
{
    public function index(Request $request)
    {
        $query = GoodsReturn::query();

        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->integer('supplier_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        return GoodsReturnResource::collection($query->latest('returned_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreGoodsReturnRequest $request, GoodsReturnService $service)
    {
        $return = $service->create($request->validated(), $request->user());

        return (new GoodsReturnResource($return))->response()->setStatusCode(201);
    }

    public function show(GoodsReturn $goods_return): GoodsReturnResource
    {
        return new GoodsReturnResource($goods_return);
    }

    public function update(UpdateGoodsReturnRequest $request, GoodsReturn $goods_return, GoodsReturnService $service): GoodsReturnResource
    {
        return new GoodsReturnResource($service->transition($goods_return, $request->validated('status')));
    }

    public function destroy(GoodsReturn $goods_return)
    {
        $goods_return->delete();

        return response()->json(null, 204);
    }
}
