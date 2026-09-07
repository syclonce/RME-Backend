<?php

namespace Modules\GeneralSitbDrugSource\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbDrugSource\Models\SitbDrugSource;

class SitbDrugSourceController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbDrugSource::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_drug_sources,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_drug_sources,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbDrugSource::create($data)->refresh(), 201);
    }

    public function show(SitbDrugSource $sitbDrugSource): SitbDrugSource
    {
        return $sitbDrugSource;
    }

    public function update(Request $request, SitbDrugSource $sitbDrugSource): SitbDrugSource
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_drug_sources', 'name')->ignore($sitbDrugSource->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_drug_sources', 'code')->ignore($sitbDrugSource->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbDrugSource->update($data);

        return $sitbDrugSource;
    }

    public function destroy(SitbDrugSource $sitbDrugSource)
    {
        $sitbDrugSource->delete();

        return response()->json(null, 204);
    }
}