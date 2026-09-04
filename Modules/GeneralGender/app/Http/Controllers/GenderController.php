<?php

namespace Modules\GeneralGender\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralGender\Models\Gender;

class GenderController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return Gender::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genders,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:genders,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Gender::create($data)->refresh(), 201);
    }

    public function show(Gender $gender): Gender
    {
        return $gender;
    }

    public function update(Request $request, Gender $gender): Gender
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('genders', 'name')->ignore($gender->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('genders', 'code')->ignore($gender->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $gender->update($data);

        return $gender;
    }

    public function destroy(Gender $gender)
    {
        $gender->delete();

        return response()->json(null, 204);
    }
}
