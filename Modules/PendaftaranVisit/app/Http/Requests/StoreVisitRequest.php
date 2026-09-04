<?php

namespace Modules\PendaftaranVisit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_number' => ['nullable', 'string', 'max:255', 'unique:visits,visit_number'],
            'registration_id' => ['required', 'integer', 'exists:registrations,id'],
            // DPJP sengaja tetap opsional: di IGD, dokter penanggung jawab kerap
            // baru ditentukan setelah triase. Penugasan menyusul dilakukan lewat
            // UpdateVisitRequest.
            'attending_physician_id' => ['nullable', 'integer', 'exists:employees,id'],
            // ward_id nullable = kunjungan RAWAT JALAN (tidak menempati bed).
            // Bukan kelalaian: VisitController::index() memakai
            // `whereNull('ward_id')` sebagai penanda rawat jalan agar petugas
            // ward tetap bisa melihatnya.
            //
            // BEDA DENGAN SIMpel, yang menetapkan `pendaftaran.kunjungan.RUANGAN`
            // NOT NULL karena di sana "ruangan" mencakup poli — sehingga rawat
            // jalan pun selalu punya ruangan tujuan (mis. Poli Umum).
            //
            // Konsekuensi yang perlu diputuskan (lihat
            // docs-sim/histori/catatan/2026-09-03-validasi-form-pasien-dan-paritas-simpel.md):
            // kunjungan rawat jalan SIMGOS saat ini tidak menyimpan poli tujuan
            // di mana pun, sehingga tidak ada antrean per-poli seperti di SIMpel.
            'ward_id' => ['nullable', 'integer', 'exists:wards,id'],
            'bed_id' => ['nullable', 'integer', 'exists:beds,id'],
            'admitted_at' => ['nullable', 'date'],
            'is_new_visit' => ['sometimes', 'boolean'],
            'is_deposit' => ['sometimes', 'boolean'],
            'deposit_class_id' => ['nullable', 'integer'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'ward_id.exists' => 'Ruangan tujuan tidak ditemukan.',
        ];
    }
}
