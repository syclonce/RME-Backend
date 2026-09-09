<?php

namespace Modules\PendaftaranConsultation\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\PendaftaranConsultationAnswer\Models\ConsultationAnswer;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\PendaftaranConsultation\Database\Factories\ConsultationFactory;
use Modules\PendaftaranVisit\Models\Visit;

class Consultation extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_PENDING = 'pending';
    public const STATUS_ANSWERED = 'answered';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'visit_id',
        'requesting_department_id',
        'consulted_department_id',
        'requested_at',
        'question',
        'status',
        'answered_at',
        'requested_by',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
            'answered_at' => 'datetime',
        ];
    }

    /** Konsul yang belum dijawab — daftar kerja unit tujuan. */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(ConsultationAnswer::class);
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function requestingDepartment(): BelongsTo
    {
        return $this->belongsTo(MedicalDepartment::class, 'requesting_department_id');
    }

    public function consultedDepartment(): BelongsTo
    {
        return $this->belongsTo(MedicalDepartment::class, 'consulted_department_id');
    }

    protected static function newFactory(): ConsultationFactory
    {
        return ConsultationFactory::new();
    }
}
