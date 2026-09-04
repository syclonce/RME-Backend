<?php

namespace Modules\GeneralVisitActivityStatus\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralVisitActivityStatus\Models\VisitActivityStatus;

class VisitActivityStatusController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return VisitActivityStatus::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:visit_activity_statuses,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:visit_activity_statuses,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(VisitActivityStatus::create($data)->refresh(), 201);
    }

    public function show(VisitActivityStatus $visitActivityStatus): VisitActivityStatus
    {
        return $visitActivityStatus;
    }

    public function update(Request $request, VisitActivityStatus $visitActivityStatus): VisitActivityStatus
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('visit_activity_statuses', 'name')->ignore($visitActivityStatus->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('visit_activity_statuses', 'code')->ignore($visitActivityStatus->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $visitActivityStatus->update($data);

        return $visitActivityStatus;
    }

    public function destroy(VisitActivityStatus $visitActivityStatus)
    {
        $visitActivityStatus->delete();

        return response()->json(null, 204);
    }
}