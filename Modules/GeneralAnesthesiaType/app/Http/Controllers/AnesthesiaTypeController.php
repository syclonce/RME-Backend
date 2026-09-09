<?php

namespace Modules\GeneralAnesthesiaType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralAnesthesiaType\Models\AnesthesiaType;

class AnesthesiaTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(AnesthesiaType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:anesthesia_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:anesthesia_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(AnesthesiaType::create($data)->refresh(), 201);
    }

    public function show(AnesthesiaType $anesthesiaType): AnesthesiaType
    {
        return $anesthesiaType;
    }

    public function update(Request $request, AnesthesiaType $anesthesiaType): AnesthesiaType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('anesthesia_types', 'name')->ignore($anesthesiaType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('anesthesia_types', 'code')->ignore($anesthesiaType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $anesthesiaType->update($data);

        return $anesthesiaType;
    }

    public function destroy(AnesthesiaType $anesthesiaType)
    {
        $anesthesiaType->delete();

        return response()->json(null, 204);
    }
}