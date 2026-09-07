<?php

namespace Modules\GeneralSitbHivStatusClassification\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbHivStatusClassification\Models\SitbHivStatusClassification;

class SitbHivStatusClassificationController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbHivStatusClassification::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_hiv_status_classifications,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_hiv_status_classifications,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbHivStatusClassification::create($data)->refresh(), 201);
    }

    public function show(SitbHivStatusClassification $sitbHivStatusClassification): SitbHivStatusClassification
    {
        return $sitbHivStatusClassification;
    }

    public function update(Request $request, SitbHivStatusClassification $sitbHivStatusClassification): SitbHivStatusClassification
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_hiv_status_classifications', 'name')->ignore($sitbHivStatusClassification->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_hiv_status_classifications', 'code')->ignore($sitbHivStatusClassification->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbHivStatusClassification->update($data);

        return $sitbHivStatusClassification;
    }

    public function destroy(SitbHivStatusClassification $sitbHivStatusClassification)
    {
        $sitbHivStatusClassification->delete();

        return response()->json(null, 204);
    }
}