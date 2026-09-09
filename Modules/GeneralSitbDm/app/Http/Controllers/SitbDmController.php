<?php

namespace Modules\GeneralSitbDm\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbDm\Models\SitbDm;

class SitbDmController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbDm::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_dms,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_dms,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbDm::create($data)->refresh(), 201);
    }

    public function show(SitbDm $sitbDm): SitbDm
    {
        return $sitbDm;
    }

    public function update(Request $request, SitbDm $sitbDm): SitbDm
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_dms', 'name')->ignore($sitbDm->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_dms', 'code')->ignore($sitbDm->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbDm->update($data);

        return $sitbDm;
    }

    public function destroy(SitbDm $sitbDm)
    {
        $sitbDm->delete();

        return response()->json(null, 204);
    }
}