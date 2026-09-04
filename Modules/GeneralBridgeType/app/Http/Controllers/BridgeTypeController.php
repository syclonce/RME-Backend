<?php

namespace Modules\GeneralBridgeType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralBridgeType\Models\BridgeType;

class BridgeTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return BridgeType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:bridge_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:bridge_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(BridgeType::create($data)->refresh(), 201);
    }

    public function show(BridgeType $bridgeType): BridgeType
    {
        return $bridgeType;
    }

    public function update(Request $request, BridgeType $bridgeType): BridgeType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('bridge_types', 'name')->ignore($bridgeType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('bridge_types', 'code')->ignore($bridgeType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $bridgeType->update($data);

        return $bridgeType;
    }

    public function destroy(BridgeType $bridgeType)
    {
        $bridgeType->delete();

        return response()->json(null, 204);
    }
}