<?php

namespace Modules\LayananMortuaryRecord\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\LayananMortuaryRecord\Database\Factories\MortuaryRecordFactory;
use Modules\PendaftaranVisit\Models\Visit;

/**
 * Kamar jenazah. Status hanya dua: in_mortuary (baru masuk) dan released
 * (sudah diambil keluarga). Transisi released HANYA lewat
 * Modules\LayananMortuaryRecord\Services\MortuaryRecordService::release() —
 * bukan tulisan langsung — supaya released_at/released_to/released_by selalu
 * lengkap saat status berubah.
 */
class MortuaryRecord extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_IN_MORTUARY = 'in_mortuary';

    public const STATUS_RELEASED = 'released';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'admitted_at',
        'released_at',
        'cause_of_death_notes',
        'released_to_name',
        'released_to_relationship',
        'released_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'admitted_at' => 'datetime',
            'released_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function releasedByEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'released_by');
    }

    protected static function newFactory(): MortuaryRecordFactory
    {
        return MortuaryRecordFactory::new();
    }
}
