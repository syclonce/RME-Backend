<?php

namespace Modules\MedicalRecordIcd10CauseOfDeathCode\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordIcd10CauseOfDeathCode\Http\Requests\StoreIcd10CauseOfDeathCodeRequest;
use Modules\MedicalRecordIcd10CauseOfDeathCode\Http\Requests\UpdateIcd10CauseOfDeathCodeRequest;
use Modules\MedicalRecordIcd10CauseOfDeathCode\Http\Resources\Icd10CauseOfDeathCodeResource;
use Modules\MedicalRecordIcd10CauseOfDeathCode\Models\Icd10CauseOfDeathCode;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class Icd10CauseOfDeathCodeController extends Controller
{
    use GuardsMedicalRecord;

    use SearchesListing;

    public function index(Request $request)
    {
        $query = Icd10CauseOfDeathCode::query();

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return Icd10CauseOfDeathCodeResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreIcd10CauseOfDeathCodeRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = Icd10CauseOfDeathCode::create($data);

        return (new Icd10CauseOfDeathCodeResource($record))->response()->setStatusCode(201);
    }

    public function show(Icd10CauseOfDeathCode $record): Icd10CauseOfDeathCodeResource
    {
        return new Icd10CauseOfDeathCodeResource($record);
    }

    public function update(UpdateIcd10CauseOfDeathCodeRequest $request, Icd10CauseOfDeathCode $record): Icd10CauseOfDeathCodeResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->update($request->validated());

        return new Icd10CauseOfDeathCodeResource($record);
    }

    public function destroy(Request $request, Icd10CauseOfDeathCode $record)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->delete();

        return response()->json(null, 204);
    }
}
