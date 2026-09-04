<?php

namespace Modules\LayananPatientDischargeRecord\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPatientDischargeRecord\Http\Requests\StorePatientDischargeRecordRequest;
use Modules\LayananPatientDischargeRecord\Http\Requests\UpdatePatientDischargeRecordRequest;
use Modules\LayananPatientDischargeRecord\Http\Resources\PatientDischargeRecordResource;
use Modules\LayananPatientDischargeRecord\Models\PatientDischargeRecord;
use Modules\PendaftaranVisit\Models\Visit;

class PatientDischargeRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientDischargeRecord::query();

        return PatientDischargeRecordResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientDischargeRecordRequest $request)
    {
        $data = $request->validated();

        // Pemulangan menutup episode — tidak boleh dobel per kunjungan, dan
        // tidak boleh dicatat di kunjungan yang sudah batal.
        $visit = Visit::query()->findOrFail($data['visit_id']);
        abort_if($visit->status === 'cancelled', 422, 'Kunjungan sudah batal; tidak dapat dipulangkan.');
        abort_if(
            PatientDischargeRecord::query()->where('visit_id', $data['visit_id'])->exists(),
            422,
            'Kunjungan ini sudah memiliki catatan pemulangan.'
        );

        $discharge_record = PatientDischargeRecord::create($data);

        return (new PatientDischargeRecordResource($discharge_record))->response()->setStatusCode(201);
    }

    public function show(PatientDischargeRecord $discharge_record): PatientDischargeRecordResource
    {
        return new PatientDischargeRecordResource($discharge_record);
    }

    public function update(UpdatePatientDischargeRecordRequest $request, PatientDischargeRecord $discharge_record): PatientDischargeRecordResource
    {
        $discharge_record->update($request->validated());

        return new PatientDischargeRecordResource($discharge_record);
    }
}
