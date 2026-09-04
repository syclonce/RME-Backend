<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepInterventionProtocol\Http\Requests\StoreBaepInterventionProtocolRequest;
use Modules\MedicalRecordBaepInterventionProtocol\Http\Requests\UpdateBaepInterventionProtocolRequest;
use Modules\MedicalRecordBaepInterventionProtocol\Http\Resources\BaepInterventionProtocolResource;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordBaepInterventionProtocol\Services\BaepInterventionProtocolService;

class BaepInterventionProtocolController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepInterventionProtocol::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return BaepInterventionProtocolResource::collection($query->latest('performed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepInterventionProtocolRequest $request, BaepInterventionProtocolService $service)
    {
        $record = $service->create($request->validated(), $request->user());

        return (new BaepInterventionProtocolResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepInterventionProtocol $record): BaepInterventionProtocolResource
    {
        return new BaepInterventionProtocolResource($record);
    }

    public function update(UpdateBaepInterventionProtocolRequest $request, BaepInterventionProtocol $record, BaepInterventionProtocolService $service): BaepInterventionProtocolResource
    {
        $validated = $request->validated();

        return new BaepInterventionProtocolResource(
            $service->transition($record, $validated['status'], $request->user(), $validated)
        );
    }
}
