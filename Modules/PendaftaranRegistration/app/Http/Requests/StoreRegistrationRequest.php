<?php

namespace Modules\PendaftaranRegistration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Modules\PendaftaranRegistration\Models\Registration;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: active, cancelled.',
            'patient_id.duplicate_daily' => 'Pasien sudah terdaftar pada tanggal ini.',
        ];
    }

    public function rules(): array
    {
        return [
            'registration_number' => ['nullable', 'string', 'max:255', 'unique:registrations,registration_number'],
            // Port legacy PendaftaranResource:63-67 (NORM+TANGGAL sama → 409
            // "sudah terdaftar"): satu pasien satu pendaftaran aktif per hari.
            // Cancelled tidak menghalangi daftar ulang — operasional nyata
            // (batal pagi, daftar lagi sore) membutuhkannya.
            'patient_id' => [
                'required',
                'integer',
                'exists:patients,id',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $date = $this->date('registered_at') ?? Carbon::now();
                    $exists = Registration::query()
                        ->where('patient_id', $value)
                        ->whereDate('registered_at', $date->toDateString())
                        ->where('status', '!=', 'cancelled')
                        ->exists();
                    if ($exists) {
                        $fail('Pasien sudah terdaftar pada tanggal ini.');
                    }
                },
            ],
            'registered_at' => ['nullable', 'date'],
            'admission_diagnosis_id' => ['nullable', 'integer', 'exists:diagnosis_codes,id'],
            'referral_id' => ['nullable', 'integer'],
            'package_id' => ['nullable', 'integer'],
            'is_emergency' => ['sometimes', 'boolean'],
            'has_fall_risk' => ['sometimes', 'boolean'],
            'newborn_weight_grams' => ['nullable', 'numeric'],
            'newborn_length_cm' => ['nullable', 'numeric'],
            'birth_time' => ['nullable', 'date_format:H:i'],
            'found_location' => ['nullable', 'string', 'max:255'],
            'found_at' => ['nullable', 'date'],
            'satu_sehat_consent' => ['sometimes', 'boolean'],
            'status' => ['sometimes', 'string', 'in:active,cancelled'],
        ];
    }
}
