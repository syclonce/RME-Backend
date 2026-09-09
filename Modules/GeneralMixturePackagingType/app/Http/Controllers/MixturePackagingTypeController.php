<?php

namespace Modules\GeneralMixturePackagingType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralMixturePackagingType\Models\MixturePackagingType;

class MixturePackagingTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(MixturePackagingType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:mixture_packaging_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:mixture_packaging_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(MixturePackagingType::create($data)->refresh(), 201);
    }

    public function show(MixturePackagingType $mixturePackagingType): MixturePackagingType
    {
        return $mixturePackagingType;
    }

    public function update(Request $request, MixturePackagingType $mixturePackagingType): MixturePackagingType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('mixture_packaging_types', 'name')->ignore($mixturePackagingType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('mixture_packaging_types', 'code')->ignore($mixturePackagingType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $mixturePackagingType->update($data);

        return $mixturePackagingType;
    }

    public function destroy(MixturePackagingType $mixturePackagingType)
    {
        $mixturePackagingType->delete();

        return response()->json(null, 204);
    }
}