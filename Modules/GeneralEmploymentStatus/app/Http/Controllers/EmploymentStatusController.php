<?php

namespace Modules\GeneralEmploymentStatus\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralEmploymentStatus\Models\EmploymentStatus;

class EmploymentStatusController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return EmploymentStatus::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:employment_statuses,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:employment_statuses,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(EmploymentStatus::create($data)->refresh(), 201);
    }

    public function show(EmploymentStatus $employmentStatus): EmploymentStatus
    {
        return $employmentStatus;
    }

    public function update(Request $request, EmploymentStatus $employmentStatus): EmploymentStatus
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('employment_statuses', 'name')->ignore($employmentStatus->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('employment_statuses', 'code')->ignore($employmentStatus->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $employmentStatus->update($data);

        return $employmentStatus;
    }

    public function destroy(EmploymentStatus $employmentStatus)
    {
        $employmentStatus->delete();

        return response()->json(null, 204);
    }
}