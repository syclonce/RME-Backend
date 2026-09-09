<?php

namespace Modules\GeneralVisitType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralVisitType\Models\VisitType;

class VisitTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(VisitType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:visit_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:visit_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(VisitType::create($data)->refresh(), 201);
    }

    public function show(VisitType $visitType): VisitType
    {
        return $visitType;
    }

    public function update(Request $request, VisitType $visitType): VisitType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('visit_types', 'name')->ignore($visitType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('visit_types', 'code')->ignore($visitType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $visitType->update($data);

        return $visitType;
    }

    public function destroy(VisitType $visitType)
    {
        $visitType->delete();

        return response()->json(null, 204);
    }
}