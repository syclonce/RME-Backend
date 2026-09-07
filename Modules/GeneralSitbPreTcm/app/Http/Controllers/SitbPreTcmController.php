<?php

namespace Modules\GeneralSitbPreTcm\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbPreTcm\Models\SitbPreTcm;

class SitbPreTcmController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbPreTcm::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_pre_tcms,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_pre_tcms,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbPreTcm::create($data)->refresh(), 201);
    }

    public function show(SitbPreTcm $sitbPreTcm): SitbPreTcm
    {
        return $sitbPreTcm;
    }

    public function update(Request $request, SitbPreTcm $sitbPreTcm): SitbPreTcm
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_pre_tcms', 'name')->ignore($sitbPreTcm->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_pre_tcms', 'code')->ignore($sitbPreTcm->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbPreTcm->update($data);

        return $sitbPreTcm;
    }

    public function destroy(SitbPreTcm $sitbPreTcm)
    {
        $sitbPreTcm->delete();

        return response()->json(null, 204);
    }
}