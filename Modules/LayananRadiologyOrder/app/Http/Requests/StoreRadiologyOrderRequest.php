<?php

namespace Modules\LayananRadiologyOrder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;

class StoreRadiologyOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'ordering_doctor_id' => ['nullable', 'integer', 'exists:employees,id'],
            // Diserap dari StoreImagingOrderRequest: modality/body_part opsional
            // di sini karena order radiologi non-imaging tetap valid tanpanya.
            'modality' => ['nullable', 'string', Rule::in(RadiologyOrder::MODALITIES)],
            'body_part' => ['nullable', 'string'],
            'ordered_at' => ['nullable', 'date'],
            'clinical_notes' => ['nullable', 'string'],
            // status TIDAK diterima dari input: RadiologyOrderService selalu
            // memaksa 'pending' saat create, sama seperti LabOrderService —
            // mencegah klien menyuntik status=completed sejak awal dan
            // melewati seluruh gerbang transisi.
        ];
    }
}
