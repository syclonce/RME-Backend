<?php

namespace Modules\MedicalRecordPressureUlcerRiskAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Database\Factories\PressureUlcerRiskAssessmentFactory;

class PressureUlcerRiskAssessment extends Model
{
    use HasFactory;

    protected $table = 'pressure_ulcer_risk_assessments';

    /**
     * Hitung total skor risiko luka tekan (skala Braden) dari keenam sub-itemnya.
     *
     * Skor DIHITUNG di sini, tidak diterima mentah dari klien. Skala Braden
     * menentukan intervensi pencegahan luka tekan (reposisi berkala, matras
     * khusus, dst) — total yang salah ketik menghilangkan intervensi itu tanpa
     * tanda apa pun di layar.
     *
     * Keenam sub-item sudah dibatasi nilai sahnya oleh FormRequest
     * (sensory_perception 1-4, moisture 1-4, activity 1-4, mobility 1-4,
     * nutrition 1-4, friction_shear 1-3), jadi rentang total 6-23.
     */
    public static function calculateTotalScore(array $items): int
    {
        return (int) ($items['sensory_perception'] ?? 0)
            + (int) ($items['moisture'] ?? 0)
            + (int) ($items['activity'] ?? 0)
            + (int) ($items['mobility'] ?? 0)
            + (int) ($items['nutrition'] ?? 0)
            + (int) ($items['friction_shear'] ?? 0);
    }

    /**
     * Tingkat risiko menurut ambang baku skala Braden — PERHATIAN: arahnya
     * TERBALIK dari Morse/Humpty Dumpty, skor RENDAH berarti risiko TINGGI.
     * Ambang klasik Braden: <=9 severe, 10-12 high, 13-14 moderate, 15-18 mild,
     * 19-23 no risk. Kolom `risk_level` di skema ini hanya punya 4 kategori
     * (tidak ada severe_risk terpisah), jadi pita <=9 severe digabung ke
     * high_risk supaya tetap konsisten dengan enum yang ada.
     */
    public static function riskLevelFor(int $totalScore): string
    {
        return match (true) {
            $totalScore <= 12 => 'high_risk',
            $totalScore <= 14 => 'moderate_risk',
            $totalScore <= 18 => 'mild_risk',
            default => 'no_risk',
        };
    }

    protected $fillable = [
        'visit_id',
        'sensory_perception',
        'moisture',
        'activity',
        'mobility',
        'nutrition',
        'friction_shear',
        'total_score',
        'risk_level',
        'assessed_at',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): PressureUlcerRiskAssessmentFactory
    {
        return PressureUlcerRiskAssessmentFactory::new();
    }
}
