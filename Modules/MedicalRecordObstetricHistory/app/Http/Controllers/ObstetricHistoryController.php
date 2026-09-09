<?php

namespace Modules\MedicalRecordObstetricHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordObstetricHistory\Http\Requests\StoreObstetricHistoryRequest;
use Modules\MedicalRecordObstetricHistory\Http\Resources\ObstetricHistoryResource;
use Modules\MedicalRecordObstetricHistory\Models\ObstetricHistory;

class ObstetricHistoryController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = ObstetricHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ObstetricHistoryResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreObstetricHistoryRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['created_by'] = $request->user()->id;

        $record = ObstetricHistory::create($data);

        return (new ObstetricHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(ObstetricHistory $record): ObstetricHistoryResource
    {
        return new ObstetricHistoryResource($record);
    }
}
