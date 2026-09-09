<?php

namespace Modules\LayananTelemedicineSession\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananTelemedicineSession\Database\Factories\TelemedicineSessionFactory;
use Modules\PendaftaranVisit\Models\Visit;

class TelemedicineSession extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $table = 'telemedicine_sessions';

    public const STATUS_SCHEDULED = 'scheduled';

    public const STATUS_ONGOING = 'ongoing';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    /** Mesin status linear: scheduled -> ongoing -> completed, plus cabang cancelled. */
    public const STATUSES = [
        self::STATUS_SCHEDULED,
        self::STATUS_ONGOING,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
    ];

    protected $fillable = [
        'visit_id',
        'doctor_employee_id',
        'scheduled_at',
        'started_at',
        'ended_at',
        'session_url',
        'status',
        'consultation_notes',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function doctorEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'doctor_employee_id');
    }

    protected static function newFactory(): TelemedicineSessionFactory
    {
        return TelemedicineSessionFactory::new();
    }
}
