<?php

namespace Modules\GeneralSitbChildTbScore0To13\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbChildTbScore0To13\Models\SitbChildTbScore0To13;

class SitbChildTbScore0To13Controller extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbChildTbScore0To13::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_child_tb_score0_to13s,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_child_tb_score0_to13s,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbChildTbScore0To13::create($data)->refresh(), 201);
    }

    public function show(SitbChildTbScore0To13 $sitbChildTbScore0To13): SitbChildTbScore0To13
    {
        return $sitbChildTbScore0To13;
    }

    public function update(Request $request, SitbChildTbScore0To13 $sitbChildTbScore0To13): SitbChildTbScore0To13
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_child_tb_score0_to13s', 'name')->ignore($sitbChildTbScore0To13->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_child_tb_score0_to13s', 'code')->ignore($sitbChildTbScore0To13->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbChildTbScore0To13->update($data);

        return $sitbChildTbScore0To13;
    }

    public function destroy(SitbChildTbScore0To13 $sitbChildTbScore0To13)
    {
        $sitbChildTbScore0To13->delete();

        return response()->json(null, 204);
    }
}