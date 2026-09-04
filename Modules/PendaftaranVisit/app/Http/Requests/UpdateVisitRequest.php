<?php

namespace Modules\PendaftaranVisit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('visit')?->id;

        return [
            'visit_number' => ['nullable', 'string', 'max:255', Rule::unique('visits', 'visit_number')->ignore($id)],
            'attending_physician_id' => ['nullable', 'integer', 'exists:employees,id'],
            'ward_id' => ['nullable', 'integer', 'exists:wards,id'],
            'bed_id' => ['nullable', 'integer', 'exists:beds,id'],
            'discharged_at' => ['nullable', 'date'],
            'is_deposit' => ['sometimes', 'boolean'],
            'deposit_class_id' => ['nullable', 'integer'],
            'final_outcome' => ['nullable', 'string', 'max:255'],
            // 'status' SENGAJA tidak ada di sini. VisitController::update()
            // menolak setiap payload yang memuatnya, karena tiap perpindahan
            // status kunjungan punya gerbangnya sendiri (bed dibebaskan,
            // tagihan diperiksa). Mencantumkannya di sini hanya membuat
            // pembaca mengira status dapat diubah lewat edit biasa.
        ];
    }
}
