<?php

namespace Modules\PendaftaranSelfCheckin\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralWard\Models\Ward;
use Modules\Auth\Models\User;
use Modules\PendaftaranSelfCheckin\Database\Factories\SelfCheckinQueueFactory;

class SelfCheckinQueue extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_WAITING = 'waiting';

    public const STATUS_CALLED = 'called';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_NO_SHOW = 'no_show';

    protected $fillable = [
        'patient_id',
        'nik',
        'queue_number',
        'ward_id',
        'queue_date',
        'checked_in_at',
        'status',
        'called_at',
        'called_by',
    ];

    protected function casts(): array
    {
        return [
            'queue_date' => 'date',
            'checked_in_at' => 'datetime',
            'called_at' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function calledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'called_by');
    }

    /**
     * Antrian masih bisa diproses petugas (belum selesai/dilanjuti).
     */
    public function isActive(): bool
    {
        return in_array($this->status, [self::STATUS_WAITING, self::STATUS_CALLED], true);
    }

    protected static function newFactory(): SelfCheckinQueueFactory
    {
        return SelfCheckinQueueFactory::new();
    }
}
