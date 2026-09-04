<?php

namespace Modules\GeneralSitbChildTbScore5\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbChildTbScore5\Models\SitbChildTbScore5;

class SitbChildTbScore5Controller extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbChildTbScore5::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_child_tb_score5s,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_child_tb_score5s,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbChildTbScore5::create($data)->refresh(), 201);
    }

    public function show(SitbChildTbScore5 $sitbChildTbScore5): SitbChildTbScore5
    {
        return $sitbChildTbScore5;
    }

    public function update(Request $request, SitbChildTbScore5 $sitbChildTbScore5): SitbChildTbScore5
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_child_tb_score5s', 'name')->ignore($sitbChildTbScore5->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_child_tb_score5s', 'code')->ignore($sitbChildTbScore5->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbChildTbScore5->update($data);

        return $sitbChildTbScore5;
    }

    public function destroy(SitbChildTbScore5 $sitbChildTbScore5)
    {
        $sitbChildTbScore5->delete();

        return response()->json(null, 204);
    }
}