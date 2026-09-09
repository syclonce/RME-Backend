<?php

namespace Modules\GeneralDepositType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralDepositType\Models\DepositType;

class DepositTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(DepositType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:deposit_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:deposit_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(DepositType::create($data)->refresh(), 201);
    }

    public function show(DepositType $depositType): DepositType
    {
        return $depositType;
    }

    public function update(Request $request, DepositType $depositType): DepositType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('deposit_types', 'name')->ignore($depositType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('deposit_types', 'code')->ignore($depositType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $depositType->update($data);

        return $depositType;
    }

    public function destroy(DepositType $depositType)
    {
        $depositType->delete();

        return response()->json(null, 204);
    }
}