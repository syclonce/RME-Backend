<?php

namespace Modules\GeneralOperationClass\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralOperationClass\Models\OperationClass;

class OperationClassController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return OperationClass::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:operation_classes,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:operation_classes,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(OperationClass::create($data)->refresh(), 201);
    }

    public function show(OperationClass $operationClass): OperationClass
    {
        return $operationClass;
    }

    public function update(Request $request, OperationClass $operationClass): OperationClass
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('operation_classes', 'name')->ignore($operationClass->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('operation_classes', 'code')->ignore($operationClass->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $operationClass->update($data);

        return $operationClass;
    }

    public function destroy(OperationClass $operationClass)
    {
        $operationClass->delete();

        return response()->json(null, 204);
    }
}