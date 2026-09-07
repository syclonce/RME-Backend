<?php

namespace Modules\GeneralSitbOatGuideline\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbOatGuideline\Models\SitbOatGuideline;

class SitbOatGuidelineController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbOatGuideline::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_oat_guidelines,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_oat_guidelines,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbOatGuideline::create($data)->refresh(), 201);
    }

    public function show(SitbOatGuideline $sitbOatGuideline): SitbOatGuideline
    {
        return $sitbOatGuideline;
    }

    public function update(Request $request, SitbOatGuideline $sitbOatGuideline): SitbOatGuideline
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_oat_guidelines', 'name')->ignore($sitbOatGuideline->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_oat_guidelines', 'code')->ignore($sitbOatGuideline->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbOatGuideline->update($data);

        return $sitbOatGuideline;
    }

    public function destroy(SitbOatGuideline $sitbOatGuideline)
    {
        $sitbOatGuideline->delete();

        return response()->json(null, 204);
    }
}