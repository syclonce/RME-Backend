<?php

namespace Modules\LayananLabAnalyzerOrder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabAnalyzerOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 'status' sengaja tidak ada di sini: order baru selalu mulai dari
     * 'ordered' di service. Field lain persis yang dipakai service.
     */
    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'vendor_id' => ['nullable', 'integer', 'exists:lab_analyzer_vendors,id'],
            'test_code' => ['required', 'string', 'max:255'],
            'ordered_by' => ['nullable', 'integer', 'exists:employees,id'],
            'ordered_at' => ['nullable', 'date'],
        ];
    }
}
