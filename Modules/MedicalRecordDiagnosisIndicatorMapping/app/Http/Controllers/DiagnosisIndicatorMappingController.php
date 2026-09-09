<?php

namespace Modules\MedicalRecordDiagnosisIndicatorMapping\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDiagnosisIndicatorMapping\Http\Requests\StoreDiagnosisIndicatorMappingRequest;
use Modules\MedicalRecordDiagnosisIndicatorMapping\Http\Requests\UpdateDiagnosisIndicatorMappingRequest;
use Modules\MedicalRecordDiagnosisIndicatorMapping\Http\Resources\DiagnosisIndicatorMappingResource;
use Modules\MedicalRecordDiagnosisIndicatorMapping\Models\DiagnosisIndicatorMapping;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class DiagnosisIndicatorMappingController extends Controller
{
    use GuardsMedicalRecord;

    use SearchesListing;

    public function index(Request $request)
    {
        $query = DiagnosisIndicatorMapping::query();

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini
        // filternya diabaikan diam-diam saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        if ($request->filled('diagnosis_id')) {
            $query->where('diagnosis_id', $request->integer('diagnosis_id'));
        }

        return DiagnosisIndicatorMappingResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreDiagnosisIndicatorMappingRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = DiagnosisIndicatorMapping::create($data);

        return (new DiagnosisIndicatorMappingResource($record))->response()->setStatusCode(201);
    }

    public function show(DiagnosisIndicatorMapping $record): DiagnosisIndicatorMappingResource
    {
        return new DiagnosisIndicatorMappingResource($record);
    }

    public function update(UpdateDiagnosisIndicatorMappingRequest $request, DiagnosisIndicatorMapping $record): DiagnosisIndicatorMappingResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->update($request->validated());

        return new DiagnosisIndicatorMappingResource($record);
    }

    public function destroy(Request $request, DiagnosisIndicatorMapping $record)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->delete();

        return response()->noContent();
    }
}
