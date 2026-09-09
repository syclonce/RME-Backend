<?php

namespace Modules\LayananPathologyAnatomyResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPathologyAnatomyResult\Http\Requests\StorePathologyAnatomyResultRequest;
use Modules\LayananPathologyAnatomyResult\Http\Requests\UpdatePathologyAnatomyResultRequest;
use Modules\LayananPathologyAnatomyResult\Http\Resources\PathologyAnatomyResultResource;
use Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult;
use Modules\LayananPathologyAnatomyResult\Services\PathologyAnatomyResultService;

class PathologyAnatomyResultController extends Controller
{
    public function index(Request $request)
    {
        $query = PathologyAnatomyResult::query();

        return PathologyAnatomyResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePathologyAnatomyResultRequest $request, PathologyAnatomyResultService $service)
    {
        $pa_result = $service->create($request->validated(), $request->user());

        return (new PathologyAnatomyResultResource($pa_result))->response()->setStatusCode(201);
    }

    public function show(PathologyAnatomyResult $pa_result): PathologyAnatomyResultResource
    {
        return new PathologyAnatomyResultResource($pa_result);
    }

    /**
     * Hanya status yang bisa diubah lewat endpoint ini (transisi workflow) -
     * field klinis lain tidak diedit setelah dibuat, sama seperti LabOrder.
     */
    public function update(UpdatePathologyAnatomyResultRequest $request, PathologyAnatomyResult $pa_result, PathologyAnatomyResultService $service): PathologyAnatomyResultResource
    {
        return new PathologyAnatomyResultResource($service->transition(
            $pa_result,
            $request->validated('status'),
            $request->user(),
        ));
    }
}
