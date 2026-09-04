<?php

namespace Modules\GeneralAbsenceType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralAbsenceType\Models\AbsenceType;

class AbsenceTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return AbsenceType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:absence_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:absence_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(AbsenceType::create($data)->refresh(), 201);
    }

    public function show(AbsenceType $absenceType): AbsenceType
    {
        return $absenceType;
    }

    public function update(Request $request, AbsenceType $absenceType): AbsenceType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('absence_types', 'name')->ignore($absenceType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('absence_types', 'code')->ignore($absenceType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $absenceType->update($data);

        return $absenceType;
    }

    public function destroy(AbsenceType $absenceType)
    {
        $absenceType->delete();

        return response()->json(null, 204);
    }
}