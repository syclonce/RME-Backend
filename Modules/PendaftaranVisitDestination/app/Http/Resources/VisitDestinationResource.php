<?php

namespace Modules\PendaftaranVisitDestination\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VisitDestinationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'registration_id' => $this->registration_id,
            'ward_id' => $this->ward_id,
            'ward_name' => $this->whenLoaded('ward', fn () => $this->ward?->name),
            'doctor_id' => $this->doctor_id,
            'doctor_name' => $this->whenLoaded('doctor', fn () => $this->doctor?->name),
            'follows_mother' => $this->follows_mother,
            'mother_visit_id' => $this->mother_visit_id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
