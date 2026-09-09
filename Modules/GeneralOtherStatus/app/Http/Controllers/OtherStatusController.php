<?php

namespace Modules\GeneralOtherStatus\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralOtherStatus\Models\OtherStatus;

class OtherStatusController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(OtherStatus::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:other_statuses,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:other_statuses,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(OtherStatus::create($data)->refresh(), 201);
    }

    public function show(OtherStatus $otherStatus): OtherStatus
    {
        return $otherStatus;
    }

    public function update(Request $request, OtherStatus $otherStatus): OtherStatus
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('other_statuses', 'name')->ignore($otherStatus->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('other_statuses', 'code')->ignore($otherStatus->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $otherStatus->update($data);

        return $otherStatus;
    }

    public function destroy(OtherStatus $otherStatus)
    {
        $otherStatus->delete();

        return response()->json(null, 204);
    }
}