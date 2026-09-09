<?php

namespace Modules\MedicalRecordEpisode\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecordEpisodeTransition extends Model
{
    protected $fillable = [
        'episode_id', 'from_status', 'to_status', 'reason', 'performed_by', 'performed_at',
    ];

    protected function casts(): array
    {
        return ['performed_at' => 'datetime'];
    }
}
