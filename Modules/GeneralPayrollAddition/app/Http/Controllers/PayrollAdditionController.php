<?php

namespace Modules\GeneralPayrollAddition\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPayrollAddition\Models\PayrollAddition;

class PayrollAdditionController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(PayrollAddition::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:payroll_additions,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:payroll_additions,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PayrollAddition::create($data)->refresh(), 201);
    }

    public function show(PayrollAddition $payrollAddition): PayrollAddition
    {
        return $payrollAddition;
    }

    public function update(Request $request, PayrollAddition $payrollAddition): PayrollAddition
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('payroll_additions', 'name')->ignore($payrollAddition->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('payroll_additions', 'code')->ignore($payrollAddition->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $payrollAddition->update($data);

        return $payrollAddition;
    }

    public function destroy(PayrollAddition $payrollAddition)
    {
        $payrollAddition->delete();

        return response()->json(null, 204);
    }
}