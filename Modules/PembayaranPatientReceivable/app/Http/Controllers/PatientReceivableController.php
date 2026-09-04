<?php

namespace Modules\PembayaranPatientReceivable\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranPatientReceivable\Http\Requests\StorePatientReceivableRequest;
use Modules\PembayaranPatientReceivable\Http\Requests\TransitionPatientReceivableRequest;
use Modules\PembayaranPatientReceivable\Http\Resources\PatientReceivableResource;
use Modules\PembayaranPatientReceivable\Models\PatientReceivable;
use Modules\PembayaranPatientReceivable\Services\PatientReceivableService;

class PatientReceivableController extends Controller
{
    public function __construct(protected PatientReceivableService $service) {}

    public function index(Request $request)
    {
        $query = PatientReceivable::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return PatientReceivableResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientReceivableRequest $request)
    {
        $receivable = $this->service->create($request->validated());

        return (new PatientReceivableResource($receivable))->response()->setStatusCode(201);
    }

    public function show(PatientReceivable $patient_receivable): PatientReceivableResource
    {
        return new PatientReceivableResource($patient_receivable);
    }

    public function transition(TransitionPatientReceivableRequest $request, PatientReceivable $patient_receivable): PatientReceivableResource
    {
        $receivable = $this->service->transition($patient_receivable, $request->validated('status'));

        return new PatientReceivableResource($receivable);
    }
}
