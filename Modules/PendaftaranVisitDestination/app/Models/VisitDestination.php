<?php

namespace Modules\PendaftaranVisitDestination\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;

/**
 * Tujuan pasien: ruangan yang DIRENCANAKAN, sebelum pasien diterima.
 *
 * Bedakan dari `Visit`, yang merekam ruangan tempat pasien BENAR-BENAR dilayani.
 * Satu pendaftaran hanya boleh punya satu tujuan (ditegakkan `unique` pada
 * `registration_id`), mengikuti legacy yang memakai NOPEN sebagai kunci.
 */
class VisitDestination extends Model
{
    use Auditable, HydratesDatabaseDefaults;

    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'registration_id',
        'ward_id',
        'doctor_id',
        'follows_mother',
        'mother_visit_id',
        'status',
        'created_by',
    ];

    protected $casts = [
        'follows_mother' => 'boolean',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'doctor_id');
    }

    public function motherVisit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'mother_visit_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** Tujuan yang belum diterima petugas ruangan — isi antrean poli. */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }
}
