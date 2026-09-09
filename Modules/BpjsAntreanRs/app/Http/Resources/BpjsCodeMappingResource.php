<?php

namespace Modules\BpjsAntreanRs\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BpjsCodeMappingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ward_id' => $this->ward_id,
            'ward_name' => $this->whenLoaded('ward', fn () => $this->ward?->name),
            'employee_id' => $this->employee_id,
            'employee_name' => $this->whenLoaded('employee', fn () => $this->employee?->name),
            'bpjs_code' => $this->bpjs_code,
            'bpjs_name' => $this->bpjs_name,
            'is_active' => $this->is_active,
            'valid_from' => $this->valid_from?->toDateString(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
