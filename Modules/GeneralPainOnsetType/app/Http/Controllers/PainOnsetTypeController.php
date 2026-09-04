<?php

namespace Modules\GeneralPainOnsetType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPainOnsetType\Models\PainOnsetType;

class PainOnsetTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return PainOnsetType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:pain_onset_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:pain_onset_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PainOnsetType::create($data)->refresh(), 201);
    }

    public function show(PainOnsetType $painOnsetType): PainOnsetType
    {
        return $painOnsetType;
    }

    public function update(Request $request, PainOnsetType $painOnsetType): PainOnsetType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('pain_onset_types', 'name')->ignore($painOnsetType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('pain_onset_types', 'code')->ignore($painOnsetType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $painOnsetType->update($data);

        return $painOnsetType;
    }

    public function destroy(PainOnsetType $painOnsetType)
    {
        $painOnsetType->delete();

        return response()->json(null, 204);
    }
}