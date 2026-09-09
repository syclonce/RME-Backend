<?php

namespace Modules\GeneralHealthcareServiceType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralHealthcareServiceType\Models\HealthcareServiceType;

class HealthcareServiceTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(HealthcareServiceType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:healthcare_service_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:healthcare_service_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(HealthcareServiceType::create($data)->refresh(), 201);
    }

    public function show(HealthcareServiceType $healthcareServiceType): HealthcareServiceType
    {
        return $healthcareServiceType;
    }

    public function update(Request $request, HealthcareServiceType $healthcareServiceType): HealthcareServiceType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('healthcare_service_types', 'name')->ignore($healthcareServiceType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('healthcare_service_types', 'code')->ignore($healthcareServiceType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $healthcareServiceType->update($data);

        return $healthcareServiceType;
    }

    public function destroy(HealthcareServiceType $healthcareServiceType)
    {
        $healthcareServiceType->delete();

        return response()->json(null, 204);
    }
}