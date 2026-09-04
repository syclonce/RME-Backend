<?php

namespace Modules\GeneralPositionTitle\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPositionTitle\Models\PositionTitle;

class PositionTitleController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return PositionTitle::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:position_titles,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:position_titles,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PositionTitle::create($data)->refresh(), 201);
    }

    public function show(PositionTitle $positionTitle): PositionTitle
    {
        return $positionTitle;
    }

    public function update(Request $request, PositionTitle $positionTitle): PositionTitle
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('position_titles', 'name')->ignore($positionTitle->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('position_titles', 'code')->ignore($positionTitle->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $positionTitle->update($data);

        return $positionTitle;
    }

    public function destroy(PositionTitle $positionTitle)
    {
        $positionTitle->delete();

        return response()->json(null, 204);
    }
}