<?php

namespace Modules\GeneralIdentityCardType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralIdentityCardType\Models\IdentityCardType;

class IdentityCardTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return IdentityCardType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:identity_card_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:identity_card_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(IdentityCardType::create($data)->refresh(), 201);
    }

    public function show(IdentityCardType $identityCardType): IdentityCardType
    {
        return $identityCardType;
    }

    public function update(Request $request, IdentityCardType $identityCardType): IdentityCardType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('identity_card_types', 'name')->ignore($identityCardType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('identity_card_types', 'code')->ignore($identityCardType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $identityCardType->update($data);

        return $identityCardType;
    }

    public function destroy(IdentityCardType $identityCardType)
    {
        $identityCardType->delete();

        return response()->json(null, 204);
    }
}