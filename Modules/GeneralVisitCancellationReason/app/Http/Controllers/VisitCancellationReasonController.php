<?php

namespace Modules\GeneralVisitCancellationReason\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralVisitCancellationReason\Models\VisitCancellationReason;

class VisitCancellationReasonController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(VisitCancellationReason::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:visit_cancellation_reasons,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:visit_cancellation_reasons,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(VisitCancellationReason::create($data)->refresh(), 201);
    }

    public function show(VisitCancellationReason $visitCancellationReason): VisitCancellationReason
    {
        return $visitCancellationReason;
    }

    public function update(Request $request, VisitCancellationReason $visitCancellationReason): VisitCancellationReason
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('visit_cancellation_reasons', 'name')->ignore($visitCancellationReason->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('visit_cancellation_reasons', 'code')->ignore($visitCancellationReason->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $visitCancellationReason->update($data);

        return $visitCancellationReason;
    }

    public function destroy(VisitCancellationReason $visitCancellationReason)
    {
        $visitCancellationReason->delete();

        return response()->json(null, 204);
    }
}