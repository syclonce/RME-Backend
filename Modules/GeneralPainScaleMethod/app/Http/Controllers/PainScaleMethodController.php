<?php

namespace Modules\GeneralPainScaleMethod\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPainScaleMethod\Models\PainScaleMethod;

class PainScaleMethodController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return PainScaleMethod::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:pain_scale_methods,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:pain_scale_methods,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PainScaleMethod::create($data)->refresh(), 201);
    }

    public function show(PainScaleMethod $painScaleMethod): PainScaleMethod
    {
        return $painScaleMethod;
    }

    public function update(Request $request, PainScaleMethod $painScaleMethod): PainScaleMethod
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('pain_scale_methods', 'name')->ignore($painScaleMethod->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('pain_scale_methods', 'code')->ignore($painScaleMethod->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $painScaleMethod->update($data);

        return $painScaleMethod;
    }

    public function destroy(PainScaleMethod $painScaleMethod)
    {
        $painScaleMethod->delete();

        return response()->json(null, 204);
    }
}