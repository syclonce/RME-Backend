<?php

namespace Modules\AuditIncidentReport\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\AuditIncidentReport\Database\Factories\IncidentReportFactory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;

class IncidentReport extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    /** Kategori insiden keselamatan pasien (IKP). */
    public const CATEGORY_KPC = 'KPC';
    public const CATEGORY_KNC = 'KNC';
    public const CATEGORY_KTC = 'KTC';
    public const CATEGORY_KTD = 'KTD';
    public const CATEGORY_SENTINEL = 'SENTINEL';

    public const CATEGORIES = [
        self::CATEGORY_KPC,
        self::CATEGORY_KNC,
        self::CATEGORY_KTC,
        self::CATEGORY_KTD,
        self::CATEGORY_SENTINEL,
    ];

    /** Grading matriks risiko 5x5 (skor rendah → ekstrim). */
    public const GRADE_BIRU = 'BIRU';
    public const GRADE_HIJAU = 'HIJAU';
    public const GRADE_KUNING = 'KUNING';
    public const GRADE_MERAH = 'MERAH';

    public const GRADES = [
        self::GRADE_BIRU,
        self::GRADE_HIJAU,
        self::GRADE_KUNING,
        self::GRADE_MERAH,
    ];

    /** Status alur pelaporan: reported → under_investigation → rca_required → closed. */
    public const STATUS_REPORTED = 'reported';
    public const STATUS_UNDER_INVESTIGATION = 'under_investigation';
    public const STATUS_RCA_REQUIRED = 'rca_required';
    public const STATUS_CLOSED = 'closed';

    public const STATUSES = [
        self::STATUS_REPORTED,
        self::STATUS_UNDER_INVESTIGATION,
        self::STATUS_RCA_REQUIRED,
        self::STATUS_CLOSED,
    ];

    /**
     * risk_grade, status, sla_due_at sengaja TIDAK fillable: ketiganya
     * hanya boleh lahir dari gerbang IncidentReportService (kalkulasi
     * matriks + state machine), bukan dari mass-assignment klien.
     */
    protected $fillable = [
        'visit_id',
        'patient_id',
        'incident_category',
        'description',
        'occurred_at',
        'reported_by',
        'impact_score',
        'probability_score',
    ];

    protected function casts(): array
    {
        return [
            'occurred_at' => 'datetime',
            'sla_due_at' => 'datetime',
            'impact_score' => 'integer',
            'probability_score' => 'integer',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function reportedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'reported_by');
    }

    protected static function newFactory(): IncidentReportFactory
    {
        return IncidentReportFactory::new();
    }
}
