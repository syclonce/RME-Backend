<?php

namespace Modules\GeneralProfession\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralProfession\Models\Profession;

class ProfessionController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(Profession::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:professions,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:professions,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Profession::create($data)->refresh(), 201);
    }

    public function show(Profession $profession): Profession
    {
        return $profession;
    }

    public function update(Request $request, Profession $profession): Profession
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('professions', 'name')->ignore($profession->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('professions', 'code')->ignore($profession->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $profession->update($data);

        return $profession;
    }

    public function destroy(Profession $profession)
    {
        $profession->delete();

        return response()->json(null, 204);
    }
}
