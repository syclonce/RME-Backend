<?php

namespace Modules\GeneralDischargeCondition\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralDischargeCondition\Models\DischargeCondition;

class DischargeConditionController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return DischargeCondition::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:discharge_conditions,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:discharge_conditions,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(DischargeCondition::create($data)->refresh(), 201);
    }

    public function show(DischargeCondition $dischargeCondition): DischargeCondition
    {
        return $dischargeCondition;
    }

    public function update(Request $request, DischargeCondition $dischargeCondition): DischargeCondition
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('discharge_conditions', 'name')->ignore($dischargeCondition->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('discharge_conditions', 'code')->ignore($dischargeCondition->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $dischargeCondition->update($data);

        return $dischargeCondition;
    }

    public function destroy(DischargeCondition $dischargeCondition)
    {
        $dischargeCondition->delete();

        return response()->json(null, 204);
    }
}