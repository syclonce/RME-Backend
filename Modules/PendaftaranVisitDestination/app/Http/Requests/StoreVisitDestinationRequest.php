<?php

namespace Modules\PendaftaranVisitDestination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitDestinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // `unique` menegakkan aturan legacy "satu pendaftaran satu tujuan"
            // di lapisan validasi, agar galatnya terbaca petugas — bukan
            // pelanggaran constraint basis data yang muncul sebagai 500.
            'registration_id' => ['required', 'integer', 'exists:registrations,id', 'unique:visit_destinations,registration_id'],
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'doctor_id' => ['nullable', 'integer', 'exists:employees,id'],
            'follows_mother' => ['sometimes', 'boolean'],
            'mother_visit_id' => ['nullable', 'integer', 'exists:visits,id', 'required_if:follows_mother,true'],
        ];
    }

    public function messages(): array
    {
        return [
            'registration_id.unique' => 'Pendaftaran ini sudah memiliki ruangan tujuan. Ubah tujuan yang ada, jangan membuat baru.',
            'mother_visit_id.required_if' => 'Kunjungan ibu wajib dipilih untuk bayi yang mengikuti ibunya.',
        ];
    }
}
