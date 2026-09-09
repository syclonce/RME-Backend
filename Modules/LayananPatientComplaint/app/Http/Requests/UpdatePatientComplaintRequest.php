<?php

namespace Modules\LayananPatientComplaint\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\LayananPatientComplaint\Models\PatientComplaint;

class UpdatePatientComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: baru, diproses, selesai.',
        ];
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['sometimes', 'nullable', 'integer', 'exists:patients,id'],
            'visit_id' => ['sometimes', 'nullable', 'integer', 'exists:visits,id'],
            'category' => ['sometimes', 'string', 'in:' . implode(',', PatientComplaint::CATEGORIES)],
            'description' => ['sometimes', 'string'],
            'submitted_at' => ['sometimes', 'date'],
            // Ketiganya dipakai gerbang transisi di PatientComplaintService;
            // validasi prasyarat (handled_by utk diproses, resolution_notes
            // utk selesai, arah maju satu tahap) ada di service, bukan di sini.
            'status' => ['sometimes', 'string', 'in:baru,diproses,selesai'],
            'handled_by' => ['sometimes', 'nullable', 'integer', 'exists:employees,id'],
            'resolution_notes' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
