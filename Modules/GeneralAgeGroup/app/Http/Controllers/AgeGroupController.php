<?php

namespace Modules\GeneralAgeGroup\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralAgeGroup\Models\AgeGroup;

class AgeGroupController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(AgeGroup::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:age_groups,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:age_groups,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(AgeGroup::create($data)->refresh(), 201);
    }

    public function show(AgeGroup $ageGroup): AgeGroup
    {
        return $ageGroup;
    }

    public function update(Request $request, AgeGroup $ageGroup): AgeGroup
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('age_groups', 'name')->ignore($ageGroup->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('age_groups', 'code')->ignore($ageGroup->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $ageGroup->update($data);

        return $ageGroup;
    }

    public function destroy(AgeGroup $ageGroup)
    {
        $ageGroup->delete();

        return response()->json(null, 204);
    }
}