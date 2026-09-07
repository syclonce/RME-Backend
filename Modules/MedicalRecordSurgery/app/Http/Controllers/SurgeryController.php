<?php

namespace Modules\MedicalRecordSurgery\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordSurgery\Http\Requests\StoreSurgeryRequest;
use Modules\MedicalRecordSurgery\Http\Requests\UpdateSurgeryRequest;
use Modules\MedicalRecordSurgery\Http\Resources\SurgeryResource;
use Modules\MedicalRecordSurgery\Models\Surgery;
use Modules\MedicalRecordSurgery\Services\SurgeryService;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class SurgeryController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = Surgery::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return SurgeryResource::collection($query->latest('started_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSurgeryRequest $request, SurgeryService $service)
    {
        $surgery = $service->create($request->validated(), $request->user());

        return (new SurgeryResource($surgery))->response()->setStatusCode(201);
    }

    public function show(Surgery $surgery): SurgeryResource
    {
        return new SurgeryResource($surgery);
    }

    /**
     * Hanya transisi status (workflow) - detail operasi yang sudah dicatat
     * saat create (siapa, prosedur apa) tidak lagi bisa diubah lewat endpoint ini.
     */
    public function update(UpdateSurgeryRequest $request, Surgery $surgery, SurgeryService $service): SurgeryResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($surgery)]);

        $validated = $request->validated();

        return new SurgeryResource($service->transition(
            $surgery,
            $validated['status'],
            $request->user(),
            $validated,
        ));
    }
}
