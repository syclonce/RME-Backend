<?php

namespace Modules\GeneralMixtureType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralMixtureType\Models\MixtureType;

class MixtureTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return MixtureType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:mixture_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:mixture_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(MixtureType::create($data)->refresh(), 201);
    }

    public function show(MixtureType $mixtureType): MixtureType
    {
        return $mixtureType;
    }

    public function update(Request $request, MixtureType $mixtureType): MixtureType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('mixture_types', 'name')->ignore($mixtureType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('mixture_types', 'code')->ignore($mixtureType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $mixtureType->update($data);

        return $mixtureType;
    }

    public function destroy(MixtureType $mixtureType)
    {
        $mixtureType->delete();

        return response()->json(null, 204);
    }
}