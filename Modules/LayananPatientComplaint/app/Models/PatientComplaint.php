<?php

namespace Modules\LayananPatientComplaint\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\LayananPatientComplaint\Database\Factories\PatientComplaintFactory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;

class PatientComplaint extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_BARU = 'baru';
    public const STATUS_DIPROSES = 'diproses';
    public const STATUS_SELESAI = 'selesai';

    public const CATEGORIES = ['pelayanan', 'fasilitas', 'administrasi', 'lainnya'];

    protected $table = 'patient_complaints';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'category',
        'description',
        'submitted_at',
        'status',
        'handled_by',
        'resolution_notes',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function handledBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'handled_by');
    }

    protected static function newFactory(): PatientComplaintFactory
    {
        return PatientComplaintFactory::new();
    }
}
