<?php

namespace Modules\GeneralSitbMonth3Microscopy\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbMonth3Microscopy\Models\SitbMonth3Microscopy;

class SitbMonth3MicroscopyController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbMonth3Microscopy::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_month3_microscopies,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_month3_microscopies,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbMonth3Microscopy::create($data)->refresh(), 201);
    }

    public function show(SitbMonth3Microscopy $sitbMonth3Microscopy): SitbMonth3Microscopy
    {
        return $sitbMonth3Microscopy;
    }

    public function update(Request $request, SitbMonth3Microscopy $sitbMonth3Microscopy): SitbMonth3Microscopy
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_month3_microscopies', 'name')->ignore($sitbMonth3Microscopy->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_month3_microscopies', 'code')->ignore($sitbMonth3Microscopy->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbMonth3Microscopy->update($data);

        return $sitbMonth3Microscopy;
    }

    public function destroy(SitbMonth3Microscopy $sitbMonth3Microscopy)
    {
        $sitbMonth3Microscopy->delete();

        return response()->json(null, 204);
    }
}