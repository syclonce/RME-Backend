<?php

namespace Modules\GeneralAmbulanceFleet\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralAmbulanceFleet\Database\Factories\AmbulanceTripFactory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;

class AmbulanceTrip extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const PURPOSE_RUJUKAN_KELUAR = 'rujukan_keluar';

    public const PURPOSE_JEMPUT_PASIEN = 'jemput_pasien';

    public const PURPOSE_ANTAR_JENAZAH = 'antar_jenazah';

    public const PURPOSE_LAINNYA = 'lainnya';

    public const STATUS_ONGOING = 'ongoing';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'ambulance_id',
        'patient_id',
        'driver_employee_id',
        'purpose',
        'origin',
        'destination',
        'departed_at',
        'returned_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'departed_at' => 'datetime',
            'returned_at' => 'datetime',
        ];
    }

    public function ambulance(): BelongsTo
    {
        return $this->belongsTo(Ambulance::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'driver_employee_id');
    }

    protected static function newFactory(): AmbulanceTripFactory
    {
        return AmbulanceTripFactory::new();
    }
}
