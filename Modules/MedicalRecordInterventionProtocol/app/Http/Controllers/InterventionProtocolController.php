<?php

namespace Modules\MedicalRecordInterventionProtocol\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordInterventionProtocol\Http\Requests\StoreInterventionProtocolRequest;
use Modules\MedicalRecordInterventionProtocol\Http\Requests\UpdateInterventionProtocolRequest;
use Modules\MedicalRecordInterventionProtocol\Http\Resources\InterventionProtocolResource;
use Modules\MedicalRecordInterventionProtocol\Models\InterventionProtocol;
use Modules\MedicalRecordInterventionProtocol\Services\InterventionProtocolService;

class InterventionProtocolController extends Controller
{
    public function index(Request $request)
    {
        $query = InterventionProtocol::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return InterventionProtocolResource::collection($query->latest('started_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInterventionProtocolRequest $request, InterventionProtocolService $service)
    {
        $record = $service->create($request->validated(), $request->user());

        return (new InterventionProtocolResource($record))->response()->setStatusCode(201);
    }

    public function show(InterventionProtocol $record): InterventionProtocolResource
    {
        return new InterventionProtocolResource($record);
    }

    public function update(UpdateInterventionProtocolRequest $request, InterventionProtocol $record, InterventionProtocolService $service): InterventionProtocolResource
    {
        return new InterventionProtocolResource(
            $service->transition($record, $request->validated()['status'], $request->user())
        );
    }
}
