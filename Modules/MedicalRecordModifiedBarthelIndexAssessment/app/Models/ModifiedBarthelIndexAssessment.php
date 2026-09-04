<?php

namespace Modules\MedicalRecordModifiedBarthelIndexAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Database\Factories\ModifiedBarthelIndexAssessmentFactory;

class ModifiedBarthelIndexAssessment extends Model
{
    use HasFactory;

    protected $table = 'modified_barthel_index_assessments';

    /**
     * Hitung total skor Modified Barthel Index dari kesepuluh sub-itemnya.
     *
     * Skor DIHITUNG di sini, tidak diterima mentah dari klien. Sama seperti
     * Barthel Index biasa, instrumen ini menilai kemandirian ADL pasien — total
     * yang salah ketik bisa membuat tingkat ketergantungan pasien tercatat
     * keliru tanpa tanda apa pun di layar.
     *
     * Kesepuluh sub-item sudah dibatasi nilai sahnya oleh FormRequest
     * (feeding 0-10, bathing 0-5, personal_hygiene 0-5, dressing 0-10,
     * bowel_control 0-10, bladder_control 0-10, toilet_use 0-10,
     * chair_bed_transfer 0-15, ambulation 0-15, stairs 0-10), jadi rentang
     * total 0-100.
     *
     * CATATAN: kolom `interpretation` di skema ini adalah string bebas (nullable,
     * max:30), BUKAN enum baku. Karena ambang kategorinya tidak dikunci oleh
     * validasi yang ada, kolom ini TIDAK dihitung ulang di sini — hanya total_score.
     */
    /**
     * Tingkat kemandirian menurut ambang Modified Barthel Index (0-100).
     *
     * Ambangnya sama dengan Barthel asli — yang berbeda adalah granularitas
     * penilaian tiap sub-item (MBI memakai skala bertingkat, Barthel asli
     * biner/tiga tingkat), bukan pita interpretasinya.
     *
     * Seperti Barthel: skor TINGGI = LEBIH MANDIRI, kebalikan skala risiko.
     */
    public static function interpretationFor(int $totalScore): string
    {
        return match (true) {
            $totalScore >= 100 => 'Mandiri',
            $totalScore >= 91 => 'Ketergantungan ringan',
            $totalScore >= 62 => 'Ketergantungan sedang',
            $totalScore >= 21 => 'Ketergantungan berat',
            default => 'Ketergantungan total',
        };
    }

    public static function calculateTotalScore(array $items): int
    {
        return (int) ($items['feeding'] ?? 0)
            + (int) ($items['bathing'] ?? 0)
            + (int) ($items['personal_hygiene'] ?? 0)
            + (int) ($items['dressing'] ?? 0)
            + (int) ($items['bowel_control'] ?? 0)
            + (int) ($items['bladder_control'] ?? 0)
            + (int) ($items['toilet_use'] ?? 0)
            + (int) ($items['chair_bed_transfer'] ?? 0)
            + (int) ($items['ambulation'] ?? 0)
            + (int) ($items['stairs'] ?? 0);
    }

    protected $fillable = [
        'visit_id',
        'feeding',
        'bathing',
        'personal_hygiene',
        'dressing',
        'bowel_control',
        'bladder_control',
        'toilet_use',
        'chair_bed_transfer',
        'ambulation',
        'stairs',
        'total_score',
        'interpretation',
        'assessed_at',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): ModifiedBarthelIndexAssessmentFactory
    {
        return ModifiedBarthelIndexAssessmentFactory::new();
    }
}
