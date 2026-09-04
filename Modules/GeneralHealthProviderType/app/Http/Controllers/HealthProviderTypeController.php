<?php

namespace Modules\GeneralHealthProviderType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralHealthProviderType\Models\HealthProviderType;

class HealthProviderTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return HealthProviderType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:health_provider_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:health_provider_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(HealthProviderType::create($data)->refresh(), 201);
    }

    public function show(HealthProviderType $healthProviderType): HealthProviderType
    {
        return $healthProviderType;
    }

    public function update(Request $request, HealthProviderType $healthProviderType): HealthProviderType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('health_provider_types', 'name')->ignore($healthProviderType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('health_provider_types', 'code')->ignore($healthProviderType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $healthProviderType->update($data);

        return $healthProviderType;
    }

    public function destroy(HealthProviderType $healthProviderType)
    {
        $healthProviderType->delete();

        return response()->json(null, 204);
    }
}