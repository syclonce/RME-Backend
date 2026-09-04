<?php

namespace Modules\GeneralSitbThoraxNotDone\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbThoraxNotDone\Models\SitbThoraxNotDone;

class SitbThoraxNotDoneController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbThoraxNotDone::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_thorax_not_dones,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_thorax_not_dones,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbThoraxNotDone::create($data)->refresh(), 201);
    }

    public function show(SitbThoraxNotDone $sitbThoraxNotDone): SitbThoraxNotDone
    {
        return $sitbThoraxNotDone;
    }

    public function update(Request $request, SitbThoraxNotDone $sitbThoraxNotDone): SitbThoraxNotDone
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_thorax_not_dones', 'name')->ignore($sitbThoraxNotDone->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_thorax_not_dones', 'code')->ignore($sitbThoraxNotDone->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbThoraxNotDone->update($data);

        return $sitbThoraxNotDone;
    }

    public function destroy(SitbThoraxNotDone $sitbThoraxNotDone)
    {
        $sitbThoraxNotDone->delete();

        return response()->json(null, 204);
    }
}