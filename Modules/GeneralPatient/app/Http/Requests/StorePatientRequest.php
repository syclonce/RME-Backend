<?php

namespace Modules\GeneralPatient\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\GeneralPatient\Models\Patient;

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
            'name' => ['required_unless:is_unidentified,true', 'nullable', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'title_prefix' => ['nullable', 'string', 'max:255'],
            'title_suffix' => ['nullable', 'string', 'max:255'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date', function (string $attribute, mixed $value, \Closure $fail): void {
                // Port PasienService:427-444 simgos2: demografis 5-field (nama +
                // tgl lahir + tempat lahir + JK + alamat cocok semua → 422 + NRM
                // eksisting). NIK/MRN sudah unique di DB; yang ditangkap di sini
                // adalah pasien sama yang NIK-nya tidak diisi. Dilewati untuk
                // tak-dikenal (identitas memang belum ada) dan tgl lahir kosong.
                if ($value === null || $this->boolean('is_unidentified') || $this->boolean('is_infant')) {
                    return;
                }

                $existing = Patient::query()
                    ->where('name', $this->input('name'))
                    ->whereDate('birth_date', (string) $value)
                    ->where('birth_place', $this->input('birth_place'))
                    ->where('gender_id', $this->input('gender_id'))
                    ->where('address', $this->input('address'))
                    ->first(['id', 'name', 'medical_record_number']);

                if ($existing !== null) {
                    $fail("Pasien an. {$existing->name} telah terdaftar dengan No.RM: {$existing->medical_record_number}.");
                }
            }],
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
            // Port PasienService:357-413 (IS_BAYI): bayi dikenal wajib data Ibu
            // (nama + KTP); blok alamat dilonggarkan; dedup dilewati (identitas
            // bayi kembar tak terbedakan demografis).
            'is_infant' => ['sometimes', 'boolean'],
            'mother' => ['nullable', 'array', 'required_if:is_infant,true'],
            'mother.name' => ['required_if:is_infant,true', 'nullable', 'string', 'max:255'],
            'mother.identity_number' => ['required_if:is_infant,true', 'nullable', 'string', 'max:64'],
            'patient_status_id' => ['nullable', 'integer', 'exists:patient_statuses,id'],
            'patient_type_id' => ['nullable', 'integer', 'exists:patient_types,id'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
