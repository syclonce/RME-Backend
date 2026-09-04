<?php

namespace Modules\MedicalRecordVitalSign\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordVitalSign\Http\Requests\StoreVitalSignRequest;
use Modules\MedicalRecordVitalSign\Http\Resources\VitalSignResource;
use Modules\MedicalRecordVitalSign\Models\VitalSign;

class VitalSignController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = VitalSign::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return VitalSignResource::collection($query->latest('recorded_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Vital signs are a legal medical record - append-only, no update/delete.
     * Corrections belong in a new reading, not an edit of history.
     */
    public function store(StoreVitalSignRequest $request)
    {
        $data = $request->validated();
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['recorded_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $vitalSign = VitalSign::create($data);

        return (new VitalSignResource($vitalSign))->response()->setStatusCode(201);
    }

    public function show(VitalSign $vital_sign): VitalSignResource
    {
        return new VitalSignResource($vital_sign);
    }
}
