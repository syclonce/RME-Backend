<?php

namespace Modules\GeneralPatient\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Ubah string kosong menjadi null untuk kolom unik yang boleh dikosongkan.
     *
     * Form mengirim '' (bukan null) saat input dibiarkan kosong. Tanpa normalisasi
     * ini, aturan `unique` menganggap '' sebagai nilai nyata sehingga pasien KEDUA
     * yang dikosongkan NRM/NIK-nya akan ditolak — padahal maksudnya justru
     * "biarkan sistem yang membuatkan".
     */
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
        return [
            'medical_record_number' => ['nullable', 'string', 'max:255', 'unique:patients,medical_record_number'],
            'nik' => ['nullable', 'digits:16', 'unique:patients,nik'],
            'no_bpjs' => ['nullable', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
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
