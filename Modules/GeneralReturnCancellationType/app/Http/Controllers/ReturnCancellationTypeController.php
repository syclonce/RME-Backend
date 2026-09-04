<?php

namespace Modules\GeneralReturnCancellationType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralReturnCancellationType\Models\ReturnCancellationType;

class ReturnCancellationTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return ReturnCancellationType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:return_cancellation_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:return_cancellation_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ReturnCancellationType::create($data)->refresh(), 201);
    }

    public function show(ReturnCancellationType $returnCancellationType): ReturnCancellationType
    {
        return $returnCancellationType;
    }

    public function update(Request $request, ReturnCancellationType $returnCancellationType): ReturnCancellationType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('return_cancellation_types', 'name')->ignore($returnCancellationType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('return_cancellation_types', 'code')->ignore($returnCancellationType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $returnCancellationType->update($data);

        return $returnCancellationType;
    }

    public function destroy(ReturnCancellationType $returnCancellationType)
    {
        $returnCancellationType->delete();

        return response()->json(null, 204);
    }
}