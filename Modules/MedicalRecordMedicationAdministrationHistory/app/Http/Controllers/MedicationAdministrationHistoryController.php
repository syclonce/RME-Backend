<?php

namespace Modules\MedicalRecordMedicationAdministrationHistory\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordMedicationAdministrationHistory\Http\Requests\StoreMedicationAdministrationHistoryRequest;
use Modules\MedicalRecordMedicationAdministrationHistory\Http\Resources\MedicationAdministrationHistoryResource;
use Modules\MedicalRecordMedicationAdministrationHistory\Models\MedicationAdministrationHistory;

class MedicationAdministrationHistoryController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = MedicationAdministrationHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return MedicationAdministrationHistoryResource::collection($query->latest('administered_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicationAdministrationHistoryRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'administered_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['administered_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = MedicationAdministrationHistory::create($data);

        return (new MedicationAdministrationHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(MedicationAdministrationHistory $record): MedicationAdministrationHistoryResource
    {
        return new MedicationAdministrationHistoryResource($record);
    }
}
