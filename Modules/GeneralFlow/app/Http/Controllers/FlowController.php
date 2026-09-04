<?php

namespace Modules\GeneralFlow\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralFlow\Models\Flow;

class FlowController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return Flow::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:flows,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:flows,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Flow::create($data)->refresh(), 201);
    }

    public function show(Flow $flow): Flow
    {
        return $flow;
    }

    public function update(Request $request, Flow $flow): Flow
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('flows', 'name')->ignore($flow->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('flows', 'code')->ignore($flow->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $flow->update($data);

        return $flow;
    }

    public function destroy(Flow $flow)
    {
        $flow->delete();

        return response()->json(null, 204);
    }
}