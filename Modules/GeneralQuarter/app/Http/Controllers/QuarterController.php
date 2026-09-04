<?php

namespace Modules\GeneralQuarter\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralQuarter\Models\Quarter;

class QuarterController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return Quarter::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:quarters,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:quarters,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Quarter::create($data)->refresh(), 201);
    }

    public function show(Quarter $quarter): Quarter
    {
        return $quarter;
    }

    public function update(Request $request, Quarter $quarter): Quarter
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('quarters', 'name')->ignore($quarter->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('quarters', 'code')->ignore($quarter->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $quarter->update($data);

        return $quarter;
    }

    public function destroy(Quarter $quarter)
    {
        $quarter->delete();

        return response()->json(null, 204);
    }
}