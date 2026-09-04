<?php

namespace Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Database\Factories\HumptyDumptyFallScaleAssessmentFactory;

class HumptyDumptyFallScaleAssessment extends Model
{
    use HasFactory;

    protected $table = 'humpty_dumpty_fall_scale_assessments';

    /**
     * Hitung total skor Humpty Dumpty Fall Scale dari ketujuh sub-itemnya.
     *
     * Skor DIHITUNG di sini, tidak diterima mentah dari klien. Instrumen ini
     * (khusus pasien anak) menentukan apakah pasien dipasangi penanda risiko
     * jatuh dan pengawasan tambahan — total yang salah ketik menghilangkan
     * kewaspadaan itu tanpa satu pun tanda di layar.
     *
     * Ketujuh sub-item sudah dibatasi nilai sahnya oleh FormRequest
     * (age 1-4, gender 1-3, diagnosis 1-4, cognitive_impairment 1-3,
     * environmental 1-4, surgery_sedation 1-3, medication 1-3), jadi rentang
     * total 7-24.
     */
    public static function calculateTotalScore(array $items): int
    {
        return (int) $items['age_score']
            + (int) $items['gender_score']
            + (int) $items['diagnosis_score']
            + (int) $items['cognitive_impairment_score']
            + (int) $items['environmental_score']
            + (int) $items['surgery_sedation_score']
            + (int) $items['medication_score'];
    }

    /**
     * Tingkat risiko menurut ambang baku Humpty Dumpty Fall Scale: skor >=12
     * risiko tinggi, di bawah itu risiko rendah.
     */
    public static function riskLevelFor(int $totalScore): string
    {
        return $totalScore >= 12 ? 'HIGH' : 'LOW';
    }

    protected $fillable = [
        'visit_id',
        'assessed_by',
        'created_by',
        'age_score',
        'gender_score',
        'diagnosis_score',
        'cognitive_impairment_score',
        'environmental_score',
        'surgery_sedation_score',
        'medication_score',
        'total_score',
        'risk_level',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
            'assessed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function assessedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assessed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): HumptyDumptyFallScaleAssessmentFactory
    {
        return HumptyDumptyFallScaleAssessmentFactory::new();
    }
}
