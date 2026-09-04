<?php

namespace Modules\GeneralSitbMonth2Microscopy\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbMonth2Microscopy\Models\SitbMonth2Microscopy;

class SitbMonth2MicroscopyController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbMonth2Microscopy::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_month2_microscopies,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_month2_microscopies,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbMonth2Microscopy::create($data)->refresh(), 201);
    }

    public function show(SitbMonth2Microscopy $sitbMonth2Microscopy): SitbMonth2Microscopy
    {
        return $sitbMonth2Microscopy;
    }

    public function update(Request $request, SitbMonth2Microscopy $sitbMonth2Microscopy): SitbMonth2Microscopy
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_month2_microscopies', 'name')->ignore($sitbMonth2Microscopy->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_month2_microscopies', 'code')->ignore($sitbMonth2Microscopy->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbMonth2Microscopy->update($data);

        return $sitbMonth2Microscopy;
    }

    public function destroy(SitbMonth2Microscopy $sitbMonth2Microscopy)
    {
        $sitbMonth2Microscopy->delete();

        return response()->json(null, 204);
    }
}