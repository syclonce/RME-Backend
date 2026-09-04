<?php

namespace Modules\BpjsAntreanRs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsAntreanRs\Http\Requests\StoreBpjsCodeMappingRequest;
use Modules\BpjsAntreanRs\Http\Requests\UpdateBpjsCodeMappingRequest;
use Modules\BpjsAntreanRs\Http\Resources\BpjsCodeMappingResource;
use Modules\BpjsAntreanRs\Models\BpjsCodeMapping;
use Modules\BpjsAntreanRs\Services\BpjsCodeMappingService;

/**
 * CRUD pemetaan kodepoli/kodedokter BPJS untuk ward/employee internal.
 * Dikonsumsi AntreanDraftService::draftFromDestination() supaya kodepoli/
 * kodedokter tidak lagi harus diketik ulang pemanggil.
 */
class BpjsCodeMappingController extends Controller
{
    public function __construct(private readonly BpjsCodeMappingService $service)
    {
    }

    public function index(Request $request)
    {
        $query = BpjsCodeMapping::query()->with(['ward', 'employee']);

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->integer('employee_id'));
        }

        if ($request->boolean('active_only')) {
            $query->where('is_active', true);
        }

        return BpjsCodeMappingResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBpjsCodeMappingRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()?->id;

        $mapping = $this->service->create($data);

        return (new BpjsCodeMappingResource($mapping))->response()->setStatusCode(201);
    }

    public function show(BpjsCodeMapping $bpjs_code_mapping): BpjsCodeMappingResource
    {
        return new BpjsCodeMappingResource($bpjs_code_mapping->load(['ward', 'employee']));
    }

    public function update(UpdateBpjsCodeMappingRequest $request, BpjsCodeMapping $bpjs_code_mapping): BpjsCodeMappingResource
    {
        $mapping = $this->service->update($bpjs_code_mapping, $request->validated());

        return new BpjsCodeMappingResource($mapping->fresh(['ward', 'employee']));
    }

    public function destroy(BpjsCodeMapping $bpjs_code_mapping)
    {
        $bpjs_code_mapping->delete();

        return response()->noContent();
    }
}
