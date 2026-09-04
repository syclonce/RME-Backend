<?php

namespace Modules\GeneralSitbDmTherapy\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbDmTherapy\Models\SitbDmTherapy;

class SitbDmTherapyController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbDmTherapy::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_dm_therapies,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_dm_therapies,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbDmTherapy::create($data)->refresh(), 201);
    }

    public function show(SitbDmTherapy $sitbDmTherapy): SitbDmTherapy
    {
        return $sitbDmTherapy;
    }

    public function update(Request $request, SitbDmTherapy $sitbDmTherapy): SitbDmTherapy
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_dm_therapies', 'name')->ignore($sitbDmTherapy->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_dm_therapies', 'code')->ignore($sitbDmTherapy->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbDmTherapy->update($data);

        return $sitbDmTherapy;
    }

    public function destroy(SitbDmTherapy $sitbDmTherapy)
    {
        $sitbDmTherapy->delete();

        return response()->json(null, 204);
    }
}