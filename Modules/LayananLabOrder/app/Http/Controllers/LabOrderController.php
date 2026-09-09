<?php

namespace Modules\LayananLabOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabOrder\Http\Requests\StoreLabOrderRequest;
use Modules\LayananLabOrder\Http\Requests\UpdateLabOrderRequest;
use Modules\LayananLabOrder\Http\Resources\LabOrderResource;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabOrder\Services\LabOrderService;

class LabOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = LabOrder::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return LabOrderResource::collection($query->latest('ordered_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabOrderRequest $request, LabOrderService $service)
    {
        $order = $service->create($request->validated(), $request->user());

        return (new LabOrderResource($order))->response()->setStatusCode(201);
    }

    public function show(LabOrder $lab_order): LabOrderResource
    {
        return new LabOrderResource($lab_order->load('results'));
    }

    /**
     * Only the status field is editable here (workflow transition) - the clinical
     * order details themselves are not, same append-only reasoning as ClinicalNote.
     */
    public function update(UpdateLabOrderRequest $request, LabOrder $lab_order, LabOrderService $service): LabOrderResource
    {
        return new LabOrderResource($service->transition(
            $lab_order,
            $request->validated('status'),
            $request->user(),
        ));
    }
}
