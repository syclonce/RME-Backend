<?php

namespace Modules\GeneralEmployeeStatus\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralEmployeeStatus\Models\EmployeeStatus;

class EmployeeStatusController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return EmployeeStatus::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:employee_statuses,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:employee_statuses,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(EmployeeStatus::create($data)->refresh(), 201);
    }

    public function show(EmployeeStatus $employeeStatus): EmployeeStatus
    {
        return $employeeStatus;
    }

    public function update(Request $request, EmployeeStatus $employeeStatus): EmployeeStatus
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('employee_statuses', 'name')->ignore($employeeStatus->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('employee_statuses', 'code')->ignore($employeeStatus->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $employeeStatus->update($data);

        return $employeeStatus;
    }

    public function destroy(EmployeeStatus $employeeStatus)
    {
        $employeeStatus->delete();

        return response()->json(null, 204);
    }
}