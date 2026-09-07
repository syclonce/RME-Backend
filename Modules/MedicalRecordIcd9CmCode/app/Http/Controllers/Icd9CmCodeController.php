<?php

namespace Modules\MedicalRecordIcd9CmCode\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordIcd9CmCode\Http\Requests\StoreIcd9CmCodeRequest;
use Modules\MedicalRecordIcd9CmCode\Http\Requests\UpdateIcd9CmCodeRequest;
use Modules\MedicalRecordIcd9CmCode\Http\Resources\Icd9CmCodeResource;
use Modules\MedicalRecordIcd9CmCode\Models\Icd9CmCode;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class Icd9CmCodeController extends Controller
{
    use GuardsMedicalRecord;

    use SearchesListing;

    public function index(Request $request)
    {
        $query = Icd9CmCode::query();

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return Icd9CmCodeResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreIcd9CmCodeRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = Icd9CmCode::create($data);

        return (new Icd9CmCodeResource($record))->response()->setStatusCode(201);
    }

    public function show(Icd9CmCode $record): Icd9CmCodeResource
    {
        return new Icd9CmCodeResource($record);
    }

    public function update(UpdateIcd9CmCodeRequest $request, Icd9CmCode $record): Icd9CmCodeResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->update($request->validated());

        return new Icd9CmCodeResource($record);
    }

    public function destroy(Request $request, Icd9CmCode $record)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->delete();

        return response()->json(null, 204);
    }
}
