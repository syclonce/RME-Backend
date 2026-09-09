<?php

namespace Modules\MedicalRecordCppt\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CpptVerificationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'valid_until' => $this->valid_until?->toDateString(),
            'verified_at' => $this->verified_at?->toIso8601String(),
            'verified_by' => $this->verified_by,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
