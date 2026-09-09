<?php

namespace Modules\PendaftaranVisitDestination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;

class UpdateVisitDestinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // `registration_id` sengaja tidak dapat diubah: memindahkan tujuan ke
            // pendaftaran lain akan memutus jejak antrean yang sudah terbentuk.
            'ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'doctor_id' => ['nullable', 'integer', 'exists:employees,id'],
            'follows_mother' => ['sometimes', 'boolean'],
            'mother_visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'status' => ['sometimes', Rule::in([
                VisitDestination::STATUS_PENDING,
                VisitDestination::STATUS_ACCEPTED,
                VisitDestination::STATUS_CANCELLED,
            ])],
        ];
    }
}
