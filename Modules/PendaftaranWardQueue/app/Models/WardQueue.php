<?php

namespace Modules\PendaftaranWardQueue\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranWardQueue\Database\Factories\WardQueueFactory;

class WardQueue extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_WAITING = 'waiting';
    public const STATUS_CALLED = 'called';
    public const STATUS_SERVED = 'served';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'ward_id',
        'registration_id',
        'queue_number',
        'queue_date',
        'visit_id',
        'called_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'called_at' => 'datetime',
            'queue_date' => 'date',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    protected static function newFactory(): WardQueueFactory
    {
        return WardQueueFactory::new();
    }
}
