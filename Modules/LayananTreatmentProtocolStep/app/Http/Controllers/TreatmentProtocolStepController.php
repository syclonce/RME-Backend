<?php

namespace Modules\LayananTreatmentProtocolStep\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;
use Modules\LayananTreatmentProtocolStep\Http\Requests\StoreTreatmentProtocolStepRequest;
use Modules\LayananTreatmentProtocolStep\Http\Requests\UpdateTreatmentProtocolStepRequest;
use Modules\LayananTreatmentProtocolStep\Http\Resources\TreatmentProtocolStepResource;
use Modules\LayananTreatmentProtocolStep\Models\TreatmentProtocolStep;
use Modules\LayananTreatmentProtocol\Models\TreatmentProtocol;

class TreatmentProtocolStepController extends Controller
{
    public function index(Request $request)
    {
        $query = TreatmentProtocolStep::query();

        return TreatmentProtocolStepResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTreatmentProtocolStepRequest $request)
    {
        $data = $request->validated();

        // Menempel ke episode lewat treatment_protocol_id, bukan visit_id langsung.
        $protocol = TreatmentProtocol::query()->findOrFail($data['treatment_protocol_id']);
        app(MedicalRecordGate::class)->assertWritable((int) $protocol->visit_id, $request->user());

        $data['status'] ??= 'pending';

        $record = TreatmentProtocolStep::create($data);

        return (new TreatmentProtocolStepResource($record))->response()->setStatusCode(201);
    }

    public function show(TreatmentProtocolStep $record): TreatmentProtocolStepResource
    {
        return new TreatmentProtocolStepResource($record);
    }

    public function update(UpdateTreatmentProtocolStepRequest $request, TreatmentProtocolStep $record): TreatmentProtocolStepResource
    {
        $record->update($request->validated());

        return new TreatmentProtocolStepResource($record);
    }

    public function destroy(TreatmentProtocolStep $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
