<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipForm\Http\Requests\StoreAntimicrobialStewardshipFormRequest;
use Modules\LayananAntimicrobialStewardshipForm\Http\Requests\UpdateAntimicrobialStewardshipFormRequest;
use Modules\LayananAntimicrobialStewardshipForm\Http\Resources\AntimicrobialStewardshipFormResource;
use Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;
use Modules\LayananAntimicrobialStewardshipForm\Services\AntimicrobialStewardshipFormService;

class AntimicrobialStewardshipFormController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipForm::query();

        return AntimicrobialStewardshipFormResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipFormRequest $request, AntimicrobialStewardshipFormService $service)
    {
        $amr_form = $service->create($request->validated(), $request->user());

        return (new AntimicrobialStewardshipFormResource($amr_form))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipForm $amr_form): AntimicrobialStewardshipFormResource
    {
        return new AntimicrobialStewardshipFormResource($amr_form);
    }

    /**
     * Hanya status yang bisa diubah lewat endpoint ini (transisi workflow) -
     * keputusan approve/reject aktual dicatat oleh modul
     * LayananAntimicrobialStewardshipApproval terpisah.
     */
    public function update(UpdateAntimicrobialStewardshipFormRequest $request, AntimicrobialStewardshipForm $amr_form, AntimicrobialStewardshipFormService $service): AntimicrobialStewardshipFormResource
    {
        return new AntimicrobialStewardshipFormResource($service->transition(
            $amr_form,
            $request->validated('status'),
            $request->user(),
        ));
    }
}
