<?php

namespace Modules\GeneralSitbTreatmentOutcome\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbTreatmentOutcome\Models\SitbTreatmentOutcome;

class SitbTreatmentOutcomeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbTreatmentOutcome::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_treatment_outcomes,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_treatment_outcomes,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbTreatmentOutcome::create($data)->refresh(), 201);
    }

    public function show(SitbTreatmentOutcome $sitbTreatmentOutcome): SitbTreatmentOutcome
    {
        return $sitbTreatmentOutcome;
    }

    public function update(Request $request, SitbTreatmentOutcome $sitbTreatmentOutcome): SitbTreatmentOutcome
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_treatment_outcomes', 'name')->ignore($sitbTreatmentOutcome->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_treatment_outcomes', 'code')->ignore($sitbTreatmentOutcome->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbTreatmentOutcome->update($data);

        return $sitbTreatmentOutcome;
    }

    public function destroy(SitbTreatmentOutcome $sitbTreatmentOutcome)
    {
        $sitbTreatmentOutcome->delete();

        return response()->json(null, 204);
    }
}