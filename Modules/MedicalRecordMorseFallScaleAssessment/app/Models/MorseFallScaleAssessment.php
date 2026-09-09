<?php

namespace Modules\MedicalRecordMorseFallScaleAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordMorseFallScaleAssessment\Database\Factories\MorseFallScaleAssessmentFactory;

class MorseFallScaleAssessment extends Model
{
    use HasFactory;

    protected $table = 'morse_fall_scale_assessments';

    /**
     * Hitung total skor Morse dari keenam sub-itemnya.
     *
     * Skor DIHITUNG di sini, tidak diterima dari klien. Morse Fall Scale menentukan
     * apakah pasien dipasangi penanda risiko jatuh, gelang kuning, dan pengawasan
     * tambahan — total yang salah ketik (mis. 25 padahal 75) menghilangkan
     * kewaspadaan itu tanpa satu pun tanda di layar.
     *
     * Keenam sub-item sudah dibatasi nilai sahnya oleh FormRequest
     * (0/25, 0/15, 0/15/30, 0/20, 0/10/20, 0/15), jadi rentang total 0-125.
     */
    public static function calculateTotalScore(array $items): int
    {
        return (int) $items['history_of_falling']
            + (int) $items['secondary_diagnosis']
            + (int) $items['ambulatory_aid']
            + (int) $items['iv_therapy']
            + (int) $items['gait']
            + (int) $items['mental_status'];
    }

    /**
     * Tingkat risiko menurut ambang baku Morse: 0-24 rendah, 25-44 sedang,
     * >=45 tinggi. Diturunkan dari skor, bukan dipilih terpisah, supaya keduanya
     * tidak pernah bertentangan.
     */
    public static function riskLevelFor(int $totalScore): string
    {
        return match (true) {
            $totalScore >= 45 => 'HIGH',
            $totalScore >= 25 => 'MODERATE',
            default => 'LOW',
        };
    }

    protected $fillable = [
        'visit_id',
        'assessed_by',
        'created_by',
        'history_of_falling',
        'secondary_diagnosis',
        'ambulatory_aid',
        'iv_therapy',
        'gait',
        'mental_status',
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

    protected static function newFactory(): MorseFallScaleAssessmentFactory
    {
        return MorseFallScaleAssessmentFactory::new();
    }
}
