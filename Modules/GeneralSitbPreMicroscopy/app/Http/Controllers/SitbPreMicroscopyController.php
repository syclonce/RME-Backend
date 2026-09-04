<?php

namespace Modules\GeneralSitbPreMicroscopy\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbPreMicroscopy\Models\SitbPreMicroscopy;

class SitbPreMicroscopyController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbPreMicroscopy::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_pre_microscopies,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_pre_microscopies,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbPreMicroscopy::create($data)->refresh(), 201);
    }

    public function show(SitbPreMicroscopy $sitbPreMicroscopy): SitbPreMicroscopy
    {
        return $sitbPreMicroscopy;
    }

    public function update(Request $request, SitbPreMicroscopy $sitbPreMicroscopy): SitbPreMicroscopy
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_pre_microscopies', 'name')->ignore($sitbPreMicroscopy->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_pre_microscopies', 'code')->ignore($sitbPreMicroscopy->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbPreMicroscopy->update($data);

        return $sitbPreMicroscopy;
    }

    public function destroy(SitbPreMicroscopy $sitbPreMicroscopy)
    {
        $sitbPreMicroscopy->delete();

        return response()->json(null, 204);
    }
}