<?php

namespace Modules\GeneralPatientIdentityCard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPatientIdentityCard\Models\PatientIdentityCard;

class PatientIdentityCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Filter opsional `patient_id` - dipakai frontend untuk prefill daftar
     * kartu identitas milik satu pasien saat dialog Ubah dibuka (lihat pola
     * yang sama di PatientContactController/PatientFamilyController).
     */
    public function index(Request $request)
    {
        $query = PatientIdentityCard::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return response()->json($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|integer',
            'identity_card_type_id' => 'nullable|integer|exists:identity_card_types,id',
            // Port PasienService:415-425 simgos2: tiap KARTUIDENTITAS dicari
            // JENIS+NOMOR; bila milik pasien lain → 422 + NRM pemilik.
            'identity_number' => ['required', 'string', 'max:255', function (string $attribute, mixed $value, \Closure $fail) use ($request): void {
                $owner = PatientIdentityCard::query()
                    ->where('identity_card_type_id', $request->input('identity_card_type_id'))
                    ->where('identity_number', $value)
                    ->where('patient_id', '!=', $request->input('patient_id'))
                    ->with('patient:id,medical_record_number')
                    ->first();

                if ($owner !== null) {
                    $fail("Kartu identitas ini telah terdaftar untuk No.RM: {$owner->patient?->medical_record_number}.");
                }
            }],
            'address' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'postal_code' => 'nullable|string|max:10',
            'village_id' => 'nullable|integer',
            'is_same_as_current_address' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $model = PatientIdentityCard::create($validated);
        return response()->json(['data' => $model], 201);
    }

    public function show($id)
    {
        return response()->json(['data' => PatientIdentityCard::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'patient_id' => 'required|integer',
            'identity_card_type_id' => 'nullable|integer|exists:identity_card_types,id',
            'identity_number' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'postal_code' => 'nullable|string|max:10',
            'village_id' => 'nullable|integer',
            'is_same_as_current_address' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $model = PatientIdentityCard::findOrFail($id);
        $model->update($validated);
        return response()->json(['data' => $model]);
    }

    public function destroy($id)
    {
        $model = PatientIdentityCard::findOrFail($id);
        $model->delete();
        return response()->json(null, 204);
    }
}
