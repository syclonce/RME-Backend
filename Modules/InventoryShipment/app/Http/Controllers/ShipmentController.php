<?php

namespace Modules\InventoryShipment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryShipment\Http\Requests\StoreShipmentRequest;
use Modules\InventoryShipment\Http\Requests\UpdateShipmentRequest;
use Modules\InventoryShipment\Http\Resources\ShipmentResource;
use Modules\InventoryShipment\Models\Shipment;
use Modules\InventoryShipment\Services\ShipmentService;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Shipment::query();

        if ($request->filled('from_ward_id')) {
            $query->where('from_ward_id', $request->integer('from_ward_id'));
        }

        if ($request->filled('to_ward_id')) {
            $query->where('to_ward_id', $request->integer('to_ward_id'));
        }

        return ShipmentResource::collection($query->latest('shipped_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreShipmentRequest $request, ShipmentService $service)
    {
        $shipment = $service->create($request->validated());

        return (new ShipmentResource($shipment))->response()->setStatusCode(201);
    }

    public function show(Shipment $shipment): ShipmentResource
    {
        return new ShipmentResource($shipment);
    }

    public function update(UpdateShipmentRequest $request, Shipment $shipment, ShipmentService $service): ShipmentResource
    {
        return new ShipmentResource($service->transition($shipment, $request->validated('status')));
    }
}
