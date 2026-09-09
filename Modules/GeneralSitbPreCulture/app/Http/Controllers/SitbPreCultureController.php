<?php

namespace Modules\GeneralSitbPreCulture\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbPreCulture\Models\SitbPreCulture;

class SitbPreCultureController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbPreCulture::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_pre_cultures,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_pre_cultures,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbPreCulture::create($data)->refresh(), 201);
    }

    public function show(SitbPreCulture $sitbPreCulture): SitbPreCulture
    {
        return $sitbPreCulture;
    }

    public function update(Request $request, SitbPreCulture $sitbPreCulture): SitbPreCulture
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_pre_cultures', 'name')->ignore($sitbPreCulture->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_pre_cultures', 'code')->ignore($sitbPreCulture->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbPreCulture->update($data);

        return $sitbPreCulture;
    }

    public function destroy(SitbPreCulture $sitbPreCulture)
    {
        $sitbPreCulture->delete();

        return response()->json(null, 204);
    }
}