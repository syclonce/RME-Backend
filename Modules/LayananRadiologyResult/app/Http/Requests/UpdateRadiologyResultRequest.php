<?php

namespace Modules\LayananRadiologyResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRadiologyResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'radiology_order_id' => ['sometimes', 'integer', 'exists:radiology_orders,id'],
            'study_instance_uid' => ['sometimes', 'nullable', 'string', 'unique:radiology_results,study_instance_uid'],
            'findings' => ['sometimes', 'string'],
            'impression' => ['sometimes', 'string'],
            'report_url' => ['sometimes', 'nullable', 'string'],
            'radiologist_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'examined_at' => ['sometimes', 'date'],
            'status' => ['sometimes', Rule::in(['pending', 'final'])],
        ];
    }
}
