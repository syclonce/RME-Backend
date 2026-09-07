<?php

namespace Modules\GeneralSitbEndMicroscopy\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbEndMicroscopy\Models\SitbEndMicroscopy;

class SitbEndMicroscopyController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbEndMicroscopy::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_end_microscopies,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_end_microscopies,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbEndMicroscopy::create($data)->refresh(), 201);
    }

    public function show(SitbEndMicroscopy $sitbEndMicroscopy): SitbEndMicroscopy
    {
        return $sitbEndMicroscopy;
    }

    public function update(Request $request, SitbEndMicroscopy $sitbEndMicroscopy): SitbEndMicroscopy
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_end_microscopies', 'name')->ignore($sitbEndMicroscopy->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_end_microscopies', 'code')->ignore($sitbEndMicroscopy->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbEndMicroscopy->update($data);

        return $sitbEndMicroscopy;
    }

    public function destroy(SitbEndMicroscopy $sitbEndMicroscopy)
    {
        $sitbEndMicroscopy->delete();

        return response()->json(null, 204);
    }
}