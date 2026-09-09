<?php

namespace Modules\GeneralWard\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralWard\Models\Ward;

class WardController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini
        // filternya diabaikan diam-diam saat petugas mengetik.
        $query = $this->applySearch(Ward::query(), $request);

        return $query
            ->with('visitType')
            ->orderBy('name')
            ->paginate(min(max($request->integer('per_page', 15), 1), 100))
            ->through(function (Ward $ward) {
                $ward->setAttribute('triggers_emergency', (bool) ($ward->visitType?->triggers_emergency_flag ?? false));
                $ward->setAttribute('visit_type_name', $ward->visitType?->name);

                return $ward;
            });
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:wards,name'],
            'type_id' => ['nullable', 'integer'],
            'visit_type_id' => ['nullable', 'integer'],
            'allows_request' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['created_by'] = $request->user()->id;

        return response()->json(Ward::create($data)->refresh(), 201);
    }

    public function show(Ward $ward): Ward
    {
        $ward->loadMissing('visitType');
        $ward->setAttribute('triggers_emergency', (bool) ($ward->visitType?->triggers_emergency_flag ?? false));

        return $ward;
    }

    public function update(Request $request, Ward $ward): Ward
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('wards', 'name')->ignore($ward->id)],
            'type_id' => ['nullable', 'integer'],
            'visit_type_id' => ['nullable', 'integer'],
            'allows_request' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $ward->update($data);

        return $ward;
    }

    public function destroy(Ward $ward)
    {
        $ward->delete();

        return response()->json(null, 204);
    }
}
