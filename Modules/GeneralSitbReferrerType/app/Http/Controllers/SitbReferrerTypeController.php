<?php

namespace Modules\GeneralSitbReferrerType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbReferrerType\Models\SitbReferrerType;

class SitbReferrerTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbReferrerType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_referrer_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_referrer_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbReferrerType::create($data)->refresh(), 201);
    }

    public function show(SitbReferrerType $sitbReferrerType): SitbReferrerType
    {
        return $sitbReferrerType;
    }

    public function update(Request $request, SitbReferrerType $sitbReferrerType): SitbReferrerType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_referrer_types', 'name')->ignore($sitbReferrerType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_referrer_types', 'code')->ignore($sitbReferrerType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbReferrerType->update($data);

        return $sitbReferrerType;
    }

    public function destroy(SitbReferrerType $sitbReferrerType)
    {
        $sitbReferrerType->delete();

        return response()->json(null, 204);
    }
}