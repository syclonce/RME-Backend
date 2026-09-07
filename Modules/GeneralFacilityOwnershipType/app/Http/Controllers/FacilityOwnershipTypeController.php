<?php

namespace Modules\GeneralFacilityOwnershipType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralFacilityOwnershipType\Models\FacilityOwnershipType;

class FacilityOwnershipTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(FacilityOwnershipType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:facility_ownership_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:facility_ownership_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(FacilityOwnershipType::create($data)->refresh(), 201);
    }

    public function show(FacilityOwnershipType $facilityOwnershipType): FacilityOwnershipType
    {
        return $facilityOwnershipType;
    }

    public function update(Request $request, FacilityOwnershipType $facilityOwnershipType): FacilityOwnershipType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('facility_ownership_types', 'name')->ignore($facilityOwnershipType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('facility_ownership_types', 'code')->ignore($facilityOwnershipType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $facilityOwnershipType->update($data);

        return $facilityOwnershipType;
    }

    public function destroy(FacilityOwnershipType $facilityOwnershipType)
    {
        $facilityOwnershipType->delete();

        return response()->json(null, 204);
    }
}