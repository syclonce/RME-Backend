<?php

namespace Modules\GeneralMedicalPersonnelType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralMedicalPersonnelType\Models\MedicalPersonnelType;

class MedicalPersonnelTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(MedicalPersonnelType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:medical_personnel_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:medical_personnel_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(MedicalPersonnelType::create($data)->refresh(), 201);
    }

    public function show(MedicalPersonnelType $medicalPersonnelType): MedicalPersonnelType
    {
        return $medicalPersonnelType;
    }

    public function update(Request $request, MedicalPersonnelType $medicalPersonnelType): MedicalPersonnelType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('medical_personnel_types', 'name')->ignore($medicalPersonnelType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('medical_personnel_types', 'code')->ignore($medicalPersonnelType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $medicalPersonnelType->update($data);

        return $medicalPersonnelType;
    }

    public function destroy(MedicalPersonnelType $medicalPersonnelType)
    {
        $medicalPersonnelType->delete();

        return response()->json(null, 204);
    }
}