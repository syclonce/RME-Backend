<?php

namespace Modules\MedicalRecordCppt\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\MedicalRecordCppt\Models\CpptVerification;

class StoreCpptVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'valid_until.unique' => 'Kunjungan ini sudah terverifikasi sampai tanggal tersebut.',
        ];
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            // Satu kunjungan satu verifikasi per tanggal-batas. whereDate (bukan
            // Rule::unique) karena kolom tersimpan sebagai datetime sementara
            // input berupa tanggal — perbandingan string mentah lolos dan
            // meledak sebagai 500 di constraint DB.
            'valid_until' => ['required', 'date', function (string $attribute, mixed $value, \Closure $fail): void {
                $exists = CpptVerification::query()
                    ->where('visit_id', $this->input('visit_id'))
                    ->whereDate('valid_until', (string) $value)
                    ->exists();

                if ($exists) {
                    $fail('Kunjungan ini sudah terverifikasi sampai tanggal tersebut.');
                }
            }],
        ];
    }
}
