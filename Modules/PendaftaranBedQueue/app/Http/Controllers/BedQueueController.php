<?php

namespace Modules\PendaftaranBedQueue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranBedQueue\Http\Requests\StoreBedQueueRequest;
use Modules\PendaftaranBedQueue\Http\Requests\UpdateBedQueueRequest;
use Modules\PendaftaranBedQueue\Http\Resources\BedQueueResource;
use Modules\PendaftaranBedQueue\Models\BedQueue;
use Modules\PendaftaranBedQueue\Services\BedQueueService;

class BedQueueController extends Controller
{
    public function index(Request $request)
    {
        $query = BedQueue::query();

        if ($request->filled('bed_id')) {
            $query->where('bed_id', $request->integer('bed_id'));
        }

        return BedQueueResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBedQueueRequest $request, BedQueueService $service)
    {
        $queue = $service->create($request->validated());

        return (new BedQueueResource($queue))->response()->setStatusCode(201);
    }

    public function show(BedQueue $bedQueue): BedQueueResource
    {
        return new BedQueueResource($bedQueue);
    }

    public function update(UpdateBedQueueRequest $request, BedQueue $bedQueue, BedQueueService $service): BedQueueResource
    {
        return new BedQueueResource($service->transition($bedQueue, $request->validated('status')));
    }
}
