<?php

namespace Modules\GeneralPathologyExaminationType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPathologyExaminationType\Models\PathologyExaminationType;

class PathologyExaminationTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return PathologyExaminationType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:pathology_examination_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:pathology_examination_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PathologyExaminationType::create($data)->refresh(), 201);
    }

    public function show(PathologyExaminationType $pathologyExaminationType): PathologyExaminationType
    {
        return $pathologyExaminationType;
    }

    public function update(Request $request, PathologyExaminationType $pathologyExaminationType): PathologyExaminationType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('pathology_examination_types', 'name')->ignore($pathologyExaminationType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('pathology_examination_types', 'code')->ignore($pathologyExaminationType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $pathologyExaminationType->update($data);

        return $pathologyExaminationType;
    }

    public function destroy(PathologyExaminationType $pathologyExaminationType)
    {
        $pathologyExaminationType->delete();

        return response()->json(null, 204);
    }
}