<?php

namespace Modules\LayananMedicationIteration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicationIterationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'quantity.min' => 'Jumlah minimal 1.',
        ];
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['required', 'integer', 'exists:prescriptions,id'],
            'iteration_number' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
            // status TIDAK diterima saat create — iterasi baru selalu mulai
            // 'pending' (lihat MedicationIterationService::create()).
        ];
    }
}
