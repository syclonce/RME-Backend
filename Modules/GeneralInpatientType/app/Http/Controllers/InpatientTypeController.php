<?php

namespace Modules\GeneralInpatientType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralInpatientType\Models\InpatientType;

class InpatientTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(InpatientType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:inpatient_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:inpatient_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(InpatientType::create($data)->refresh(), 201);
    }

    public function show(InpatientType $inpatientType): InpatientType
    {
        return $inpatientType;
    }

    public function update(Request $request, InpatientType $inpatientType): InpatientType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('inpatient_types', 'name')->ignore($inpatientType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('inpatient_types', 'code')->ignore($inpatientType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $inpatientType->update($data);

        return $inpatientType;
    }

    public function destroy(InpatientType $inpatientType)
    {
        $inpatientType->delete();

        return response()->json(null, 204);
    }
}