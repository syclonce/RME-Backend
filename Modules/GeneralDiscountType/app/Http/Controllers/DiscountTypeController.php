<?php

namespace Modules\GeneralDiscountType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralDiscountType\Models\DiscountType;

class DiscountTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(DiscountType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:discount_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:discount_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(DiscountType::create($data)->refresh(), 201);
    }

    public function show(DiscountType $discountType): DiscountType
    {
        return $discountType;
    }

    public function update(Request $request, DiscountType $discountType): DiscountType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('discount_types', 'name')->ignore($discountType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('discount_types', 'code')->ignore($discountType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $discountType->update($data);

        return $discountType;
    }

    public function destroy(DiscountType $discountType)
    {
        $discountType->delete();

        return response()->json(null, 204);
    }
}