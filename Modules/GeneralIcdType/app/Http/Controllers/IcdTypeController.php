<?php

namespace Modules\GeneralIcdType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralIcdType\Models\IcdType;

class IcdTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(IcdType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:icd_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:icd_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(IcdType::create($data)->refresh(), 201);
    }

    public function show(IcdType $icdType): IcdType
    {
        return $icdType;
    }

    public function update(Request $request, IcdType $icdType): IcdType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('icd_types', 'name')->ignore($icdType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('icd_types', 'code')->ignore($icdType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $icdType->update($data);

        return $icdType;
    }

    public function destroy(IcdType $icdType)
    {
        $icdType->delete();

        return response()->json(null, 204);
    }
}