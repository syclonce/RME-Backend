<?php

namespace Modules\GeneralSitbPpk\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbPpk\Models\SitbPpk;

class SitbPpkController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbPpk::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_ppks,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_ppks,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbPpk::create($data)->refresh(), 201);
    }

    public function show(SitbPpk $sitbPpk): SitbPpk
    {
        return $sitbPpk;
    }

    public function update(Request $request, SitbPpk $sitbPpk): SitbPpk
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_ppks', 'name')->ignore($sitbPpk->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_ppks', 'code')->ignore($sitbPpk->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbPpk->update($data);

        return $sitbPpk;
    }

    public function destroy(SitbPpk $sitbPpk)
    {
        $sitbPpk->delete();

        return response()->json(null, 204);
    }
}