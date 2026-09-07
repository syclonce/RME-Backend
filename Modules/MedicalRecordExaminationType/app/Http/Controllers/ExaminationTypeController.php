<?php

namespace Modules\MedicalRecordExaminationType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordExaminationType\Http\Requests\StoreExaminationTypeRequest;
use Modules\MedicalRecordExaminationType\Http\Requests\UpdateExaminationTypeRequest;
use Modules\MedicalRecordExaminationType\Http\Resources\ExaminationTypeResource;
use Modules\MedicalRecordExaminationType\Models\ExaminationType;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class ExaminationTypeController extends Controller
{
    use GuardsMedicalRecord;

    use SearchesListing;

    public function index(Request $request)
    {
        $query = ExaminationType::query();

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return ExaminationTypeResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreExaminationTypeRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = ExaminationType::create($data);

        return (new ExaminationTypeResource($record))->response()->setStatusCode(201);
    }

    public function show(ExaminationType $record): ExaminationTypeResource
    {
        return new ExaminationTypeResource($record);
    }

    public function update(UpdateExaminationTypeRequest $request, ExaminationType $record): ExaminationTypeResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->update($request->validated());

        return new ExaminationTypeResource($record);
    }

    public function destroy(Request $request, ExaminationType $record)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->delete();

        return response()->json(null, 204);
    }
}
