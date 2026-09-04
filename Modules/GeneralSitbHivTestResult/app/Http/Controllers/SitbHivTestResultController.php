<?php

namespace Modules\GeneralSitbHivTestResult\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbHivTestResult\Models\SitbHivTestResult;

class SitbHivTestResultController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return SitbHivTestResult::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_hiv_test_results,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_hiv_test_results,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbHivTestResult::create($data)->refresh(), 201);
    }

    public function show(SitbHivTestResult $sitbHivTestResult): SitbHivTestResult
    {
        return $sitbHivTestResult;
    }

    public function update(Request $request, SitbHivTestResult $sitbHivTestResult): SitbHivTestResult
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_hiv_test_results', 'name')->ignore($sitbHivTestResult->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_hiv_test_results', 'code')->ignore($sitbHivTestResult->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $sitbHivTestResult->update($data);

        return $sitbHivTestResult;
    }

    public function destroy(SitbHivTestResult $sitbHivTestResult)
    {
        $sitbHivTestResult->delete();

        return response()->json(null, 204);
    }
}