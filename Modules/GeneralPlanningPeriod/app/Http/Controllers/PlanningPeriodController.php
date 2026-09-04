<?php

namespace Modules\GeneralPlanningPeriod\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPlanningPeriod\Models\PlanningPeriod;

class PlanningPeriodController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return PlanningPeriod::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:planning_periods,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:planning_periods,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PlanningPeriod::create($data)->refresh(), 201);
    }

    public function show(PlanningPeriod $planningPeriod): PlanningPeriod
    {
        return $planningPeriod;
    }

    public function update(Request $request, PlanningPeriod $planningPeriod): PlanningPeriod
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('planning_periods', 'name')->ignore($planningPeriod->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('planning_periods', 'code')->ignore($planningPeriod->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $planningPeriod->update($data);

        return $planningPeriod;
    }

    public function destroy(PlanningPeriod $planningPeriod)
    {
        $planningPeriod->delete();

        return response()->json(null, 204);
    }
}