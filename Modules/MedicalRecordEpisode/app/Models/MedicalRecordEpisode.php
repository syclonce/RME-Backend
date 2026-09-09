<?php

namespace Modules\MedicalRecordEpisode\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\PendaftaranVisit\Models\Visit;

class MedicalRecordEpisode extends Model
{
    use Auditable, HydratesDatabaseDefaults;

    public const STATUS_OPEN = 'open';
    public const STATUS_FINALIZED = 'finalized';
    public const STATUS_AMENDING = 'amending';

    protected $fillable = ['visit_id', 'status', 'version', 'finalized_at', 'finalized_by'];

    protected function casts(): array
    {
        return ['finalized_at' => 'datetime', 'version' => 'integer'];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function transitions(): HasMany
    {
        return $this->hasMany(MedicalRecordEpisodeTransition::class, 'episode_id');
    }
}
