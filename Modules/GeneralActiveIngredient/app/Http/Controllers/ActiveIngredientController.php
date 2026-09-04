<?php

namespace Modules\GeneralActiveIngredient\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralActiveIngredient\Models\ActiveIngredient;

class ActiveIngredientController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return ActiveIngredient::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:active_ingredients,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:active_ingredients,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ActiveIngredient::create($data)->refresh(), 201);
    }

    public function show(ActiveIngredient $activeIngredient): ActiveIngredient
    {
        return $activeIngredient;
    }

    public function update(Request $request, ActiveIngredient $activeIngredient): ActiveIngredient
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('active_ingredients', 'name')->ignore($activeIngredient->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('active_ingredients', 'code')->ignore($activeIngredient->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $activeIngredient->update($data);

        return $activeIngredient;
    }

    public function destroy(ActiveIngredient $activeIngredient)
    {
        $activeIngredient->delete();

        return response()->json(null, 204);
    }
}