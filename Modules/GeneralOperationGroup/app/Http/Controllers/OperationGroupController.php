<?php

namespace Modules\GeneralOperationGroup\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralOperationGroup\Models\OperationGroup;

class OperationGroupController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return OperationGroup::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:operation_groups,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:operation_groups,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(OperationGroup::create($data)->refresh(), 201);
    }

    public function show(OperationGroup $operationGroup): OperationGroup
    {
        return $operationGroup;
    }

    public function update(Request $request, OperationGroup $operationGroup): OperationGroup
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('operation_groups', 'name')->ignore($operationGroup->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('operation_groups', 'code')->ignore($operationGroup->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $operationGroup->update($data);

        return $operationGroup;
    }

    public function destroy(OperationGroup $operationGroup)
    {
        $operationGroup->delete();

        return response()->json(null, 204);
    }
}