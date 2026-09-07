<?php

namespace Modules\GeneralSitbChestXrayResult\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbChestXrayResult\Models\SitbChestXrayResult;

class SitbChestXrayResultController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbChestXrayResult::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_chest_xray_results,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_chest_xray_results,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbChestXrayResult::create($data)->refresh(), 201);
    }

    public function show(SitbChestXrayResult $sitbChestXrayResult): SitbChestXrayResult
    {
        return $sitbChestXrayResult;
    }

    public function update(Request $request, SitbChestXrayResult $sitbChestXrayResult): SitbChestXrayResult
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_chest_xray_results', 'name')->ignore($sitbChestXrayResult->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_chest_xray_results', 'code')->ignore($sitbChestXrayResult->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbChestXrayResult->update($data);

        return $sitbChestXrayResult;
    }

    public function destroy(SitbChestXrayResult $sitbChestXrayResult)
    {
        $sitbChestXrayResult->delete();

        return response()->json(null, 204);
    }
}