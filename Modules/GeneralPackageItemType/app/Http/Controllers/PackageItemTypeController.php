<?php

namespace Modules\GeneralPackageItemType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPackageItemType\Models\PackageItemType;

class PackageItemTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return PackageItemType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:package_item_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:package_item_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PackageItemType::create($data)->refresh(), 201);
    }

    public function show(PackageItemType $packageItemType): PackageItemType
    {
        return $packageItemType;
    }

    public function update(Request $request, PackageItemType $packageItemType): PackageItemType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('package_item_types', 'name')->ignore($packageItemType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('package_item_types', 'code')->ignore($packageItemType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $packageItemType->update($data);

        return $packageItemType;
    }

    public function destroy(PackageItemType $packageItemType)
    {
        $packageItemType->delete();

        return response()->json(null, 204);
    }
}