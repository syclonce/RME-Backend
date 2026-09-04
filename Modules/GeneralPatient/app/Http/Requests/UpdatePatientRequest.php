<?php

namespace Modules\GeneralPatient\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** Lihat StorePatientRequest::prepareForValidation() — alasan yang sama. */
    protected function prepareForValidation(): void
    {
        $nullable = [];

        foreach (['medical_record_number', 'nik', 'no_bpjs'] as $field) {
            if ($this->has($field) && $this->input($field) === '') {
                $nullable[$field] = null;
            }
        }

        if ($nullable !== []) {
            $this->merge($nullable);
        }
    }

    public function rules(): array
    {
        $id = $this->route('patient')?->id;

        return [
            'medical_record_number' => ['nullable', 'string', 'max:255', Rule::unique('patients', 'medical_record_number')->ignore($id)],
            'nik' => ['nullable', 'digits:16', Rule::unique('patients', 'nik')->ignore($id)],
            'no_bpjs' => ['nullable', 'string', 'max:20'],
            'name' => ['sometimes', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'title_prefix' => ['nullable', 'string', 'max:255'],
            'title_suffix' => ['nullable', 'string', 'max:255'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'gender_id' => ['nullable', 'integer', 'exists:genders,id'],
            'religion_id' => ['nullable', 'integer', 'exists:religions,id'],
            'address' => ['nullable', 'string', 'max:255'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'village_id' => ['nullable', 'integer', 'exists:indonesia_villages,id'],
            'education_id' => ['nullable', 'integer', 'exists:educations,id'],
            'occupation_id' => ['nullable', 'integer', 'exists:occupations,id'],
            'marital_status_id' => ['nullable', 'integer', 'exists:marital_statuses,id'],
            'blood_type_id' => ['nullable', 'integer', 'exists:blood_types,id'],
            'nationality_id' => ['nullable', 'integer', 'exists:countries,id'],
            'ethnicity_id' => ['nullable', 'integer', 'exists:ethnicities,id'],
            'language_id' => ['nullable', 'integer', 'exists:languages,id'],
            'is_unidentified' => ['sometimes', 'boolean'],
            'patient_status_id' => ['nullable', 'integer', 'exists:patient_statuses,id'],
            'patient_type_id' => ['nullable', 'integer', 'exists:patient_types,id'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
