<?php

namespace Modules\MedicalRecordVitalSign\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVitalSignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'systolic.between' => 'Tekanan sistolik di luar rentang wajar (0-300 mmHg). Periksa kembali angkanya.',
            'diastolic.between' => 'Tekanan diastolik di luar rentang wajar (0-200 mmHg). Periksa kembali angkanya.',
            'pulse.between' => 'Nadi di luar rentang wajar (0-300 kali/menit). Periksa kembali angkanya.',
            'respiratory_rate.between' => 'Laju napas di luar rentang wajar (0-120 kali/menit). Periksa kembali angkanya.',
            'temperature.between' => 'Suhu di luar rentang wajar (30-45 °C). Periksa kembali angkanya.',
        ];
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'recorded_at' => ['nullable', 'date'],
            'temperature' => ['nullable', 'numeric', 'between:30,45'],
            // Batas atas fisiologis, bukan sekadar min:0. Nadi 9000 atau
            // sistolik 30000 adalah salah ketik yang, sekali tersimpan di
            // rekam medis append-only, tidak dapat dihapus -- hanya dapat
            // dibantah oleh pencatatan berikutnya.
            'pulse' => ['nullable', 'integer', 'between:0,300'],
            'respiratory_rate' => ['nullable', 'integer', 'between:0,120'],
            'systolic' => ['nullable', 'integer', 'between:0,300'],
            'diastolic' => ['nullable', 'integer', 'between:0,200'],
            'oxygen_saturation' => ['nullable', 'integer', 'between:0,100'],
            'pain_scale' => ['nullable', 'integer', 'between:0,10'],
            // Boleh kosong: diisi server dari profil pegawai user login.
            // Petugas tidak menghafal id pegawainya sendiri.
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
        ];
    }
}
