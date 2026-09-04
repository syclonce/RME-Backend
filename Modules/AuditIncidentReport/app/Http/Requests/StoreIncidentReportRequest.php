<?php

namespace Modules\AuditIncidentReport\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\AuditIncidentReport\Models\IncidentReport;

class StoreIncidentReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Hanya field input mentah. risk_grade/status/sla_due_at dihitung
     * IncidentReportService::create() — tidak divalidasi di sini agar tak
     * bisa disuntik klien.
     */
    public function rules(): array
    {
        return [
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'patient_id' => ['nullable', 'integer', 'exists:patients,id'],
            'incident_category' => ['required', 'string', 'in:' . implode(',', IncidentReport::CATEGORIES)],
            'description' => ['required', 'string', 'max:65535'],
            'occurred_at' => ['required', 'date'],
            'reported_by' => ['nullable', 'integer', 'exists:employees,id'],
            'impact_score' => ['required', 'integer', 'min:1', 'max:5'],
            'probability_score' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }
}
