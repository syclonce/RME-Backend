<?php

namespace Modules\GeneralSitbMonth5Microscopy\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbMonth5Microscopy\Models\SitbMonth5Microscopy;

class SitbMonth5MicroscopyController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbMonth5Microscopy::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_month5_microscopies,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_month5_microscopies,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbMonth5Microscopy::create($data)->refresh(), 201);
    }

    public function show(SitbMonth5Microscopy $sitbMonth5Microscopy): SitbMonth5Microscopy
    {
        return $sitbMonth5Microscopy;
    }

    public function update(Request $request, SitbMonth5Microscopy $sitbMonth5Microscopy): SitbMonth5Microscopy
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_month5_microscopies', 'name')->ignore($sitbMonth5Microscopy->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_month5_microscopies', 'code')->ignore($sitbMonth5Microscopy->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbMonth5Microscopy->update($data);

        return $sitbMonth5Microscopy;
    }

    public function destroy(SitbMonth5Microscopy $sitbMonth5Microscopy)
    {
        $sitbMonth5Microscopy->delete();

        return response()->json(null, 204);
    }
}