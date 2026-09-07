<?php

namespace Modules\GeneralOperationType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralOperationType\Models\OperationType;

class OperationTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(OperationType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:operation_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:operation_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(OperationType::create($data)->refresh(), 201);
    }

    public function show(OperationType $operationType): OperationType
    {
        return $operationType;
    }

    public function update(Request $request, OperationType $operationType): OperationType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('operation_types', 'name')->ignore($operationType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('operation_types', 'code')->ignore($operationType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $operationType->update($data);

        return $operationType;
    }

    public function destroy(OperationType $operationType)
    {
        $operationType->delete();

        return response()->json(null, 204);
    }
}