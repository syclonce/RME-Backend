<?php

namespace Modules\GeneralEducation\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralEducation\Models\Education;

class EducationController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(Education::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:educations,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:educations,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Education::create($data)->refresh(), 201);
    }

    public function show(Education $education): Education
    {
        return $education;
    }

    public function update(Request $request, Education $education): Education
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('educations', 'name')->ignore($education->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('educations', 'code')->ignore($education->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $education->update($data);

        return $education;
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return response()->json(null, 204);
    }
}
