<?php

namespace Modules\BpjsAntreanRs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * ward_id XOR employee_id ditegakkan di BpjsCodeMappingService (bukan di
 * sini) supaya aturan sama dipakai lewat jalur lain (mis. seeder/tinker),
 * tapi kita tetap validasi ada MINIMAL satu yang diisi di lapisan request.
 */
class StoreBpjsCodeMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_id' => ['nullable', 'required_without:employee_id', 'integer', 'exists:wards,id'],
            'employee_id' => ['nullable', 'required_without:ward_id', 'integer', 'exists:employees,id'],
            'bpjs_code' => ['required', 'string', 'max:20'],
            'bpjs_name' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
            'valid_from' => ['nullable', 'date'],
        ];
    }
}
