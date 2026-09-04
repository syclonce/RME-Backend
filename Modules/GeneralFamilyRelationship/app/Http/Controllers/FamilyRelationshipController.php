<?php

namespace Modules\GeneralFamilyRelationship\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralFamilyRelationship\Models\FamilyRelationship;

class FamilyRelationshipController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return FamilyRelationship::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:family_relationships,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:family_relationships,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(FamilyRelationship::create($data)->refresh(), 201);
    }

    public function show(FamilyRelationship $familyRelationship): FamilyRelationship
    {
        return $familyRelationship;
    }

    public function update(Request $request, FamilyRelationship $familyRelationship): FamilyRelationship
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('family_relationships', 'name')->ignore($familyRelationship->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('family_relationships', 'code')->ignore($familyRelationship->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $familyRelationship->update($data);

        return $familyRelationship;
    }

    public function destroy(FamilyRelationship $familyRelationship)
    {
        $familyRelationship->delete();

        return response()->json(null, 204);
    }
}