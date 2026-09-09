<?php

namespace Modules\GeneralTbPatientCategory\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralTbPatientCategory\Models\TbPatientCategory;

class TbPatientCategoryController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(TbPatientCategory::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tb_patient_categories,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:tb_patient_categories,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(TbPatientCategory::create($data)->refresh(), 201);
    }

    public function show(TbPatientCategory $tbPatientCategory): TbPatientCategory
    {
        return $tbPatientCategory;
    }

    public function update(Request $request, TbPatientCategory $tbPatientCategory): TbPatientCategory
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('tb_patient_categories', 'name')->ignore($tbPatientCategory->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('tb_patient_categories', 'code')->ignore($tbPatientCategory->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $tbPatientCategory->update($data);

        return $tbPatientCategory;
    }

    public function destroy(TbPatientCategory $tbPatientCategory)
    {
        $tbPatientCategory->delete();

        return response()->json(null, 204);
    }
}