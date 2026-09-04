<?php

namespace Modules\MedicalRecordExaminationType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordExaminationType\Http\Requests\StoreExaminationTypeRequest;
use Modules\MedicalRecordExaminationType\Http\Requests\UpdateExaminationTypeRequest;
use Modules\MedicalRecordExaminationType\Http\Resources\ExaminationTypeResource;
use Modules\MedicalRecordExaminationType\Models\ExaminationType;

class ExaminationTypeController extends Controller
{
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
        $record->update($request->validated());

        return new ExaminationTypeResource($record);
    }

    public function destroy(ExaminationType $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
