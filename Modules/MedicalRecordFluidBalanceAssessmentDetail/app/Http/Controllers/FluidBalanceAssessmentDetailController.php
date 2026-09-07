<?php

namespace Modules\MedicalRecordFluidBalanceAssessmentDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFluidBalanceAssessmentDetail\Http\Requests\StoreFluidBalanceAssessmentDetailRequest;
use Modules\MedicalRecordFluidBalanceAssessmentDetail\Http\Requests\UpdateFluidBalanceAssessmentDetailRequest;
use Modules\MedicalRecordFluidBalanceAssessmentDetail\Http\Resources\FluidBalanceAssessmentDetailResource;
use Modules\MedicalRecordFluidBalanceAssessmentDetail\Models\FluidBalanceAssessmentDetail;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class FluidBalanceAssessmentDetailController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = FluidBalanceAssessmentDetail::query();


        if ($request->filled('fluid_balance_assessment_id')) {
            $query->where('fluid_balance_assessment_id', $request->integer('fluid_balance_assessment_id'));
        }

        return FluidBalanceAssessmentDetailResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreFluidBalanceAssessmentDetailRequest $request)
    {
        $data = $request->validated();

        $record = FluidBalanceAssessmentDetail::create($data);

        return (new FluidBalanceAssessmentDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(FluidBalanceAssessmentDetail $record): FluidBalanceAssessmentDetailResource
    {
        return new FluidBalanceAssessmentDetailResource($record);
    }

    public function update(UpdateFluidBalanceAssessmentDetailRequest $request, FluidBalanceAssessmentDetail $record): FluidBalanceAssessmentDetailResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->update($request->validated());

        return new FluidBalanceAssessmentDetailResource($record);
    }

    public function destroy(Request $request, FluidBalanceAssessmentDetail $record)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->delete();

        return response()->noContent();
    }
}
