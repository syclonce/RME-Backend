<?php

namespace Modules\GeneralTreatmentCategory\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralTreatmentCategory\Models\TreatmentCategory;

class TreatmentCategoryController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return TreatmentCategory::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:treatment_categories,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:treatment_categories,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(TreatmentCategory::create($data)->refresh(), 201);
    }

    public function show(TreatmentCategory $treatmentCategory): TreatmentCategory
    {
        return $treatmentCategory;
    }

    public function update(Request $request, TreatmentCategory $treatmentCategory): TreatmentCategory
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('treatment_categories', 'name')->ignore($treatmentCategory->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('treatment_categories', 'code')->ignore($treatmentCategory->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $treatmentCategory->update($data);

        return $treatmentCategory;
    }

    public function destroy(TreatmentCategory $treatmentCategory)
    {
        $treatmentCategory->delete();

        return response()->json(null, 204);
    }
}