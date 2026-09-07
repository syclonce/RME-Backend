<?php

namespace Modules\MedicalRecordImplementationChecklistItem\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordImplementationChecklistItem\Http\Requests\StoreImplementationChecklistItemRequest;
use Modules\MedicalRecordImplementationChecklistItem\Http\Requests\UpdateImplementationChecklistItemRequest;
use Modules\MedicalRecordImplementationChecklistItem\Http\Resources\ImplementationChecklistItemResource;
use Modules\MedicalRecordImplementationChecklistItem\Models\ImplementationChecklistItem;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class ImplementationChecklistItemController extends Controller
{
    use GuardsMedicalRecord;

    use SearchesListing;

    public function index(Request $request)
    {
        $query = ImplementationChecklistItem::query();

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return ImplementationChecklistItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreImplementationChecklistItemRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = ImplementationChecklistItem::create($data);

        return (new ImplementationChecklistItemResource($record))->response()->setStatusCode(201);
    }

    public function show(ImplementationChecklistItem $record): ImplementationChecklistItemResource
    {
        return new ImplementationChecklistItemResource($record);
    }

    public function update(UpdateImplementationChecklistItemRequest $request, ImplementationChecklistItem $record): ImplementationChecklistItemResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->update($request->validated());

        return new ImplementationChecklistItemResource($record);
    }

    public function destroy(Request $request, ImplementationChecklistItem $record)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->delete();

        return response()->json(null, 204);
    }
}
