<?php

namespace Modules\GeneralSitbTreatmentHistoryClassification\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralSitbTreatmentHistoryClassification\Models\SitbTreatmentHistoryClassification;

class SitbTreatmentHistoryClassificationController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(SitbTreatmentHistoryClassification::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sitb_treatment_history_classifications,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:sitb_treatment_history_classifications,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(SitbTreatmentHistoryClassification::create($data)->refresh(), 201);
    }

    public function show(SitbTreatmentHistoryClassification $record): SitbTreatmentHistoryClassification
    {
        return $record;
    }

    public function update(Request $request, SitbTreatmentHistoryClassification $record): SitbTreatmentHistoryClassification
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('sitb_treatment_history_classifications', 'name')->ignore($record->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('sitb_treatment_history_classifications', 'code')->ignore($record->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $record->update($data);

        return $record;
    }

    public function destroy(SitbTreatmentHistoryClassification $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}