<?php

namespace Modules\LayananPharmacyServiceTimeStage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyServiceTimeStageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'recorded_at.before_or_equal' => 'Waktu pencatatan tidak boleh di masa depan.',
        ];
    }

    public function rules(): array
    {
        return [
            'pharmacy_service_time_id' => ['required', 'integer', 'exists:pharmacy_service_times,id'],
            'stage_name' => ['required', 'string', 'max:50'],
            'recorded_at' => ['nullable', 'date', 'before_or_equal:now'],
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
        ];
    }
}
