<?php

namespace Modules\LayananPharmacyReturn\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;
use Modules\LayananPharmacyReturn\Http\Requests\StorePharmacyReturnRequest;
use Modules\LayananPharmacyReturn\Http\Requests\UpdatePharmacyReturnRequest;
use Modules\LayananPharmacyReturn\Http\Resources\PharmacyReturnResource;
use Modules\LayananPharmacyReturn\Models\PharmacyReturn;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;

class PharmacyReturnController extends Controller
{
    public function index(Request $request)
    {
        $query = PharmacyReturn::query();

        return PharmacyReturnResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePharmacyReturnRequest $request)
    {
        $data = $request->validated();

        // Retur farmasi menempel ke episode lewat prescription_item -> prescription
        // -> visit_id (dua hop) — resolusi manual karena payload tidak membawa
        // visit_id langsung.
        $item = PrescriptionItem::query()->with('prescription')->findOrFail($data['prescription_item_id']);
        app(MedicalRecordGate::class)->assertWritable((int) $item->prescription->visit_id, $request->user());

        $data['status'] ??= 'pending';

        $record = PharmacyReturn::create($data);

        return (new PharmacyReturnResource($record))->response()->setStatusCode(201);
    }

    public function show(PharmacyReturn $record): PharmacyReturnResource
    {
        return new PharmacyReturnResource($record);
    }

    public function update(UpdatePharmacyReturnRequest $request, PharmacyReturn $record): PharmacyReturnResource
    {
        $record->update($request->validated());

        return new PharmacyReturnResource($record);
    }

    public function destroy(PharmacyReturn $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
