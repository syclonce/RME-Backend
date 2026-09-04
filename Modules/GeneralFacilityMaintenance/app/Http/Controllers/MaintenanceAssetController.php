<?php

namespace Modules\GeneralFacilityMaintenance\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralFacilityMaintenance\Http\Requests\StoreMaintenanceAssetRequest;
use Modules\GeneralFacilityMaintenance\Http\Requests\UpdateMaintenanceAssetRequest;
use Modules\GeneralFacilityMaintenance\Models\MaintenanceAsset;

class MaintenanceAssetController extends Controller
{
    use ResolvesActingEmployee;

    public function index(Request $request)
    {
        $query = MaintenanceAsset::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        return $query->orderBy('asset_name')->paginate($request->integer('per_page', 15));
    }

    public function store(StoreMaintenanceAssetRequest $request)
    {
        return response()->json(MaintenanceAsset::create($this->fillActingEmployee($request, $request->validated(), 'reported_by'))->refresh(), 201);
    }

    public function show(MaintenanceAsset $maintenance_asset): MaintenanceAsset
    {
        return $maintenance_asset;
    }

    public function update(UpdateMaintenanceAssetRequest $request, MaintenanceAsset $maintenance_asset): MaintenanceAsset
    {
        $maintenance_asset->update($request->validated());

        return $maintenance_asset;
    }

    public function destroy(MaintenanceAsset $maintenance_asset)
    {
        $maintenance_asset->delete();

        return response()->json(null, 204);
    }
}
