<?php

namespace Modules\MedicalRecordImmunizationVaccination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordImmunizationVaccination\Http\Requests\StoreImmunizationVaccinationRequest;
use Modules\MedicalRecordImmunizationVaccination\Http\Requests\UpdateImmunizationVaccinationRequest;
use Modules\MedicalRecordImmunizationVaccination\Http\Resources\ImmunizationVaccinationResource;
use Modules\MedicalRecordImmunizationVaccination\Models\ImmunizationVaccination;
use Modules\MedicalRecordImmunizationVaccination\Services\ImmunizationVaccinationService;

class ImmunizationVaccinationController extends Controller
{
    public function index(Request $request)
    {
        $query = ImmunizationVaccination::query();

        return ImmunizationVaccinationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreImmunizationVaccinationRequest $request, ImmunizationVaccinationService $service)
    {
        $record = $service->create($request->validated(), $request->user());

        return (new ImmunizationVaccinationResource($record))->response()->setStatusCode(201);
    }

    public function show(ImmunizationVaccination $record): ImmunizationVaccinationResource
    {
        return new ImmunizationVaccinationResource($record);
    }

    /**
     * Imunisasi adalah pencatatan sekali-jadi (diberikan lalu selesai) - tidak
     * ada transisi status bermakna (lihat ImmunizationVaccinationService).
     * Endpoint ini hanya mengoreksi field non-status (catatan reaksi, dsb),
     * tetap lewat gerbang RME supaya koreksi tidak menyentuh episode final.
     */
    public function update(UpdateImmunizationVaccinationRequest $request, ImmunizationVaccination $record, ImmunizationVaccinationService $service): ImmunizationVaccinationResource
    {
        return new ImmunizationVaccinationResource($service->update($record, $request->validated(), $request->user()));
    }

    public function destroy(Request $request, ImmunizationVaccination $record, ImmunizationVaccinationService $service)
    {
        $service->delete($record, $request->user());

        return response()->json(null, 204);
    }
}
