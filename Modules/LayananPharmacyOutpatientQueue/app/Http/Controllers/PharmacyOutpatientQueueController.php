<?php

namespace Modules\LayananPharmacyOutpatientQueue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPharmacyOutpatientQueue\Http\Requests\StorePharmacyOutpatientQueueRequest;
use Modules\LayananPharmacyOutpatientQueue\Http\Requests\UpdatePharmacyOutpatientQueueRequest;
use Modules\LayananPharmacyOutpatientQueue\Http\Resources\PharmacyOutpatientQueueResource;
use Modules\LayananPharmacyOutpatientQueue\Models\PharmacyOutpatientQueue;
use Modules\LayananPharmacyOutpatientQueue\Services\PharmacyOutpatientQueueService;

class PharmacyOutpatientQueueController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyOutpatientQueue::query();

        return PharmacyOutpatientQueueResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyOutpatientQueueRequest $request, PharmacyOutpatientQueueService $service)
    {
        $queue = $service->create($request->validated());

        return (new PharmacyOutpatientQueueResource($queue))->response()->setStatusCode(201);
    }

    public function show(PharmacyOutpatientQueue $queue): PharmacyOutpatientQueueResource
    {
        return new PharmacyOutpatientQueueResource($queue);
    }

    public function update(UpdatePharmacyOutpatientQueueRequest $request, PharmacyOutpatientQueue $queue, PharmacyOutpatientQueueService $service): PharmacyOutpatientQueueResource
    {
        return new PharmacyOutpatientQueueResource($service->transition($queue, $request->validated('status')));
    }
}
