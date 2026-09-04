<?php

namespace Modules\GeneralSitbAnatomyClassification\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbAnatomyClassification\Models\SitbAnatomyClassification;

class SitbAnatomyClassificationController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbAnatomyClassification::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_anatomy_classifications,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_anatomy_classifications,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbAnatomyClassification::create($data)->refresh(), 201);
    }

    public function show(SitbAnatomyClassification $sitbAnatomyClassification): SitbAnatomyClassification
    {
        return $sitbAnatomyClassification;
    }

    public function update(Request $request, SitbAnatomyClassification $sitbAnatomyClassification): SitbAnatomyClassification
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_anatomy_classifications', 'name')->ignore($sitbAnatomyClassification->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_anatomy_classifications', 'code')->ignore($sitbAnatomyClassification->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbAnatomyClassification->update($data);

        return $sitbAnatomyClassification;
    }

    public function destroy(SitbAnatomyClassification $sitbAnatomyClassification)
    {
        $sitbAnatomyClassification->delete();

        return response()->json(null, 204);
    }
}