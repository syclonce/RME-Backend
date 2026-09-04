<?php

namespace Modules\PendaftaranServiceHandover\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranServiceHandover\Http\Requests\ReceiveServiceHandoverRequest;
use Modules\PendaftaranServiceHandover\Http\Requests\StoreServiceHandoverRequest;
use Modules\PendaftaranServiceHandover\Http\Resources\ServiceHandoverResource;
use Modules\PendaftaranServiceHandover\Models\ServiceHandover;
use Modules\PendaftaranServiceHandover\Services\ServiceHandoverService;

class ServiceHandoverController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceHandover::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ServiceHandoverResource::collection($query->latest('handed_over_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreServiceHandoverRequest $request, ServiceHandoverService $service)
    {
        $handover = $service->create($request->validated(), $request->user());

        return (new ServiceHandoverResource($handover))->response()->setStatusCode(201);
    }

    public function show(ServiceHandover $service_handover): ServiceHandoverResource
    {
        return new ServiceHandoverResource($service_handover);
    }

    /**
     * Receiving/rejecting is a one-way transition, same as InventoryStockRequest's
     * fulfill/reject - a handover already received or rejected cannot be re-processed.
     */
    public function update(ReceiveServiceHandoverRequest $request, ServiceHandover $service_handover, ServiceHandoverService $service): ServiceHandoverResource
    {
        return new ServiceHandoverResource($service->transition($service_handover, $request->validated(), $request->user()));
    }
}
