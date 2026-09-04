<?php

namespace Modules\BpjsAntreanRs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ward_id/employee_id TIDAK bisa diubah lewat update (lihat
 * BpjsCodeMappingService::update()) — hanya field kode & status.
 */
class UpdateBpjsCodeMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bpjs_code' => ['sometimes', 'required', 'string', 'max:20'],
            'bpjs_name' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
            'valid_from' => ['nullable', 'date'],
        ];
    }
}
