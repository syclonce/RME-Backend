<?php

namespace Modules\MedicalRecordRecordFileLoan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecordFileLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => 'required|integer',
            'borrower_name' => 'required|string|max:150',
            'borrower_unit' => 'nullable|string|max:150',
            'purpose' => 'nullable|string|max:200',
            'loaned_at' => 'required|date',
            'due_at' => 'nullable|date',
            // status dan returned_at TIDAK diterima dari klien saat create —
            // peminjaman baru selalu mulai 'borrowed' (lihat
            // RecordFileLoanService::create()).
        ];
    }
}
