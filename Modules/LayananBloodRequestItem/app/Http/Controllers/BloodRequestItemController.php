<?php

namespace Modules\LayananBloodRequestItem\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;
use Modules\LayananBloodRequestItem\Http\Requests\StoreBloodRequestItemRequest;
use Modules\LayananBloodRequestItem\Http\Requests\UpdateBloodRequestItemRequest;
use Modules\LayananBloodRequestItem\Http\Resources\BloodRequestItemResource;
use Modules\LayananBloodRequestItem\Models\BloodRequestItem;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;

class BloodRequestItemController extends Controller
{
    public function index(Request $request)
    {
        $query = BloodRequestItem::query();

        return BloodRequestItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBloodRequestItemRequest $request)
    {
        $data = $request->validated();

        // Item request darah menempel ke episode kunjungan lewat
        // blood_transfusion_id, bukan visit_id langsung — resolusi visit lewat
        // parent supaya tetap tergerbang oleh MedicalRecordGate seperti modul
        // klinis lain yang menyentuh visit_id.
        $transfusion = BloodTransfusion::query()->findOrFail($data['blood_transfusion_id']);
        app(MedicalRecordGate::class)->assertWritable((int) $transfusion->visit_id, $request->user());

        $data['status'] ??= 'pending';

        $record = BloodRequestItem::create($data);

        return (new BloodRequestItemResource($record))->response()->setStatusCode(201);
    }

    public function show(BloodRequestItem $record): BloodRequestItemResource
    {
        return new BloodRequestItemResource($record);
    }

    public function update(UpdateBloodRequestItemRequest $request, BloodRequestItem $record): BloodRequestItemResource
    {
        $record->update($request->validated());

        return new BloodRequestItemResource($record);
    }

    public function destroy(BloodRequestItem $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
