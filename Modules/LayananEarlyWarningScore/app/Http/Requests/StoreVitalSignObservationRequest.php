<?php

namespace Modules\LayananEarlyWarningScore\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\LayananEarlyWarningScore\Models\VitalSignObservation;

class StoreVitalSignObservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hanya field mentah hasil pengukuran. total_score/risk_level sengaja TIDAK
     * divalidasi/diterima: keduanya dihitung server oleh EwsCalculatorService.
     * recorded_at nullable karena service mengisi now() bila tidak dikirim.
     */
    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'respiratory_rate' => ['required', 'integer', 'min:0', 'max:65535'],
            // SpO2 adalah persentase — 0..100 adalah batas fisiologisnya.
            'spo2' => ['required', 'integer', 'min:0', 'max:100'],
            'systolic_bp' => ['required', 'integer', 'min:0', 'max:65535'],
            'pulse_rate' => ['required', 'integer', 'min:0', 'max:65535'],
            'consciousness_level' => ['required', 'in:' . implode(',', [
                VitalSignObservation::CONSCIOUSNESS_ALERT,
                VitalSignObservation::CONSCIOUSNESS_VOICE,
                VitalSignObservation::CONSCIOUSNESS_PAIN,
                VitalSignObservation::CONSCIOUSNESS_UNRESPONSIVE,
            ])],
            'temperature_celsius' => ['required', 'numeric'],
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
            'recorded_at' => ['nullable', 'date'],
        ];
    }
}
