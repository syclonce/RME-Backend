<?php

namespace Modules\MedicalRecordRetentionSchedule\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\MedicalRecordRetentionSchedule\Database\Factories\RetentionScheduleFactory;
use Modules\PendaftaranRegistration\Models\Registration;

/**
 * Jadwal retensi rekam medis per registrasi, port aturan Permenkes 24/2022:
 * berkas disimpan minimal N tahun (default 25, HospitalConfig
 * 'retention.years') dihitung sejak basis_date (visit.discharged_at bila
 * kunjungan sudah pulang, jika belum dipakai "aktivitas terakhir" — lihat
 * RetentionScheduleService::resolveBasisDate()).
 *
 * status: active (masih dalam masa simpan) -> eligible_for_destruction
 * (retention_due_at sudah lewat, MedicalRecordRetentionSchedule::scan()
 * menandai otomatis) -> destroyed (ditandai manual, HANYA menandai status —
 * tidak pernah menghapus data pasien/kunjungan yang sebenarnya).
 */
class RetentionSchedule extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_ACTIVE = 'active';

    public const STATUS_ELIGIBLE_FOR_DESTRUCTION = 'eligible_for_destruction';

    public const STATUS_DESTROYED = 'destroyed';

    protected $fillable = [
        'registration_id',
        'patient_id',
        'basis_date',
        'retention_years',
        'retention_due_at',
        'status',
        'marked_by',
        'marked_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'basis_date' => 'datetime',
            'retention_years' => 'integer',
            'retention_due_at' => 'date',
            'marked_at' => 'datetime',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function markedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'marked_by');
    }

    protected static function newFactory(): RetentionScheduleFactory
    {
        return RetentionScheduleFactory::new();
    }
}
