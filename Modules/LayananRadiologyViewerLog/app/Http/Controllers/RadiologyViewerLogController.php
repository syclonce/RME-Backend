<?php

namespace Modules\LayananRadiologyViewerLog\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\LayananRadiologyViewerLog\Http\Requests\StoreRadiologyViewerLogRequest;
use Modules\LayananRadiologyViewerLog\Http\Resources\RadiologyViewerLogResource;
use Modules\LayananRadiologyViewerLog\Models\RadiologyViewerLog;

class RadiologyViewerLogController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = RadiologyViewerLog::query();

        return RadiologyViewerLogResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyViewerLogRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'viewed_by');
        $this->guardMedicalRecord($request, $data);

        $record = RadiologyViewerLog::create($data);

        return (new RadiologyViewerLogResource($record))->response()->setStatusCode(201);
    }

    public function show(RadiologyViewerLog $record): RadiologyViewerLogResource
    {
        return new RadiologyViewerLogResource($record);
    }

    public function destroy(RadiologyViewerLog $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
