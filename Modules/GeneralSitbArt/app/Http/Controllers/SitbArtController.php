<?php

namespace Modules\GeneralSitbArt\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbArt\Models\SitbArt;

class SitbArtController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbArt::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_arts,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_arts,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbArt::create($data)->refresh(), 201);
    }

    public function show(SitbArt $sitbArt): SitbArt
    {
        return $sitbArt;
    }

    public function update(Request $request, SitbArt $sitbArt): SitbArt
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_arts', 'name')->ignore($sitbArt->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_arts', 'code')->ignore($sitbArt->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbArt->update($data);

        return $sitbArt;
    }

    public function destroy(SitbArt $sitbArt)
    {
        $sitbArt->delete();

        return response()->json(null, 204);
    }
}