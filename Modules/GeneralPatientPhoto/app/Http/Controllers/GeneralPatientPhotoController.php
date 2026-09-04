<?php

namespace Modules\GeneralPatientPhoto\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\GeneralPatientPhoto\Models\PatientPhoto;

class GeneralPatientPhotoController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientPhoto::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return $query->orderBy('id')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'photo' => ['required', 'image', 'max:5120'],
            'taken_at' => ['nullable', 'date'],
        ]);

        $path = $request->file('photo')->store("patient-photos/{$data['patient_id']}", 'public');

        $photo = PatientPhoto::create([
            'patient_id' => $data['patient_id'],
            'file_path' => $path,
            'taken_at' => $data['taken_at'] ?? now(),
        ]);

        return response()->json($photo->refresh(), 201);
    }

    public function show(PatientPhoto $patientPhoto): PatientPhoto
    {
        return $patientPhoto;
    }

    public function update(Request $request, PatientPhoto $patientPhoto): PatientPhoto
    {
        $data = $request->validate([
            'photo' => ['sometimes', 'image', 'max:5120'],
            'taken_at' => ['sometimes', 'date'],
        ]);

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($patientPhoto->file_path);
            $data['file_path'] = $request->file('photo')->store("patient-photos/{$patientPhoto->patient_id}", 'public');
            unset($data['photo']);
        }

        $patientPhoto->update($data);

        return $patientPhoto;
    }

    public function destroy(PatientPhoto $patientPhoto)
    {
        Storage::disk('public')->delete($patientPhoto->file_path);
        $patientPhoto->delete();

        return response()->json(null, 204);
    }
}
