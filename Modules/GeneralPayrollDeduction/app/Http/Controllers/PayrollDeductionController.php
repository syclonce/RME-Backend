<?php

namespace Modules\GeneralPayrollDeduction\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPayrollDeduction\Models\PayrollDeduction;

class PayrollDeductionController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(PayrollDeduction::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:payroll_deductions,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:payroll_deductions,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PayrollDeduction::create($data)->refresh(), 201);
    }

    public function show(PayrollDeduction $payrollDeduction): PayrollDeduction
    {
        return $payrollDeduction;
    }

    public function update(Request $request, PayrollDeduction $payrollDeduction): PayrollDeduction
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('payroll_deductions', 'name')->ignore($payrollDeduction->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('payroll_deductions', 'code')->ignore($payrollDeduction->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $payrollDeduction->update($data);

        return $payrollDeduction;
    }

    public function destroy(PayrollDeduction $payrollDeduction)
    {
        $payrollDeduction->delete();

        return response()->json(null, 204);
    }
}