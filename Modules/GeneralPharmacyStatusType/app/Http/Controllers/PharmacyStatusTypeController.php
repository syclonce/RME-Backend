<?php

namespace Modules\GeneralPharmacyStatusType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPharmacyStatusType\Models\PharmacyStatusType;

class PharmacyStatusTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(PharmacyStatusType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:pharmacy_status_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:pharmacy_status_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PharmacyStatusType::create($data)->refresh(), 201);
    }

    public function show(PharmacyStatusType $pharmacyStatusType): PharmacyStatusType
    {
        return $pharmacyStatusType;
    }

    public function update(Request $request, PharmacyStatusType $pharmacyStatusType): PharmacyStatusType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('pharmacy_status_types', 'name')->ignore($pharmacyStatusType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('pharmacy_status_types', 'code')->ignore($pharmacyStatusType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $pharmacyStatusType->update($data);

        return $pharmacyStatusType;
    }

    public function destroy(PharmacyStatusType $pharmacyStatusType)
    {
        $pharmacyStatusType->delete();

        return response()->json(null, 204);
    }
}