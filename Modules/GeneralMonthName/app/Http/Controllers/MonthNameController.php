<?php

namespace Modules\GeneralMonthName\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralMonthName\Models\MonthName;

class MonthNameController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return MonthName::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:month_names,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:month_names,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(MonthName::create($data)->refresh(), 201);
    }

    public function show(MonthName $monthName): MonthName
    {
        return $monthName;
    }

    public function update(Request $request, MonthName $monthName): MonthName
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('month_names', 'name')->ignore($monthName->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('month_names', 'code')->ignore($monthName->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $monthName->update($data);

        return $monthName;
    }

    public function destroy(MonthName $monthName)
    {
        $monthName->delete();

        return response()->json(null, 204);
    }
}