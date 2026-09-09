<?php

namespace Modules\MedicalRecordGynecologyHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordGynecologyHistory\Http\Requests\StoreGynecologyHistoryRequest;
use Modules\MedicalRecordGynecologyHistory\Http\Resources\GynecologyHistoryResource;
use Modules\MedicalRecordGynecologyHistory\Models\GynecologyHistory;

class GynecologyHistoryController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = GynecologyHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return GynecologyHistoryResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreGynecologyHistoryRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['created_by'] = $request->user()->id;

        $record = GynecologyHistory::create($data);

        return (new GynecologyHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(GynecologyHistory $record): GynecologyHistoryResource
    {
        return new GynecologyHistoryResource($record);
    }
}
