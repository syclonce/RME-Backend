<?php

namespace Modules\GeneralPrintType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPrintType\Models\PrintType;

class PrintTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(PrintType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:print_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:print_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PrintType::create($data)->refresh(), 201);
    }

    public function show(PrintType $printType): PrintType
    {
        return $printType;
    }

    public function update(Request $request, PrintType $printType): PrintType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('print_types', 'name')->ignore($printType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('print_types', 'code')->ignore($printType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $printType->update($data);

        return $printType;
    }

    public function destroy(PrintType $printType)
    {
        $printType->delete();

        return response()->json(null, 204);
    }
}