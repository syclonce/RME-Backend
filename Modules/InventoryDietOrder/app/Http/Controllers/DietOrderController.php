<?php

namespace Modules\InventoryDietOrder\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryDietOrder\Http\Requests\StoreDietOrderRequest;
use Modules\InventoryDietOrder\Http\Requests\TransitionDietOrderStatusRequest;
use Modules\InventoryDietOrder\Http\Requests\UpdateDietOrderRequest;
use Modules\InventoryDietOrder\Http\Resources\DietOrderResource;
use Modules\InventoryDietOrder\Models\DietOrder;
use Modules\InventoryDietOrder\Services\DietOrderService;

class DietOrderController extends Controller
{
    use ResolvesActingEmployee;

    public function __construct(protected DietOrderService $dietOrderService)
    {
    }

    /**
     * GET diet-orders?visit_id=&order_date= — dipakai dapur untuk melihat
     * pesanan pada hari tertentu (order_date), difilter per shift makan lewat
     * meal_schedule bila diberikan.
     */
    public function index(Request $request)
    {
        $query = DietOrder::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('order_date')) {
            $query->whereDate('order_date', $request->date('order_date'));
        }

        if ($request->filled('meal_schedule')) {
            $query->where('meal_schedule', $request->string('meal_schedule'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        $orders = $query->orderBy('order_date')->orderBy('meal_schedule')->paginate($request->integer('per_page', 15));

        return DietOrderResource::collection($orders);
    }

    public function store(StoreDietOrderRequest $request)
    {
        $dietOrder = $this->dietOrderService->create($this->fillActingEmployee($request, $request->validated(), 'ordered_by'));

        return (new DietOrderResource($dietOrder))->response()->setStatusCode(201);
    }

    public function show(DietOrder $dietOrder): DietOrderResource
    {
        return new DietOrderResource($dietOrder);
    }

    public function update(UpdateDietOrderRequest $request, DietOrder $dietOrder): DietOrderResource
    {
        $updated = $this->dietOrderService->updateDetails($dietOrder, $request->validated());

        return new DietOrderResource($updated);
    }

    /** PATCH diet-orders/{diet_order}/status — transisi state machine lewat service. */
    public function transitionStatus(TransitionDietOrderStatusRequest $request, DietOrder $dietOrder): DietOrderResource
    {
        $updated = $this->dietOrderService->transitionStatus($dietOrder, $request->validated()['status']);

        return new DietOrderResource($updated);
    }

    public function destroy(DietOrder $dietOrder)
    {
        $this->dietOrderService->delete($dietOrder);

        return response()->json(null, 204);
    }
}
