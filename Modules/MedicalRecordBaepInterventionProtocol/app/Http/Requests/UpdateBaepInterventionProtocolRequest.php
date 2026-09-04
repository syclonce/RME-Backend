<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBaepInterventionProtocolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:in_progress,completed'],
            'click_rate_hz' => ['nullable', 'numeric', 'min:0'],
            'stimulus_intensity_db' => ['nullable', 'integer', 'min:0', 'max:130'],
            'wave_i_latency_ms' => ['nullable', 'numeric'],
            'wave_iii_latency_ms' => ['nullable', 'numeric'],
            'wave_v_latency_ms' => ['nullable', 'numeric'],
            'interpretation' => ['nullable', 'string'],
        ];
    }
}
