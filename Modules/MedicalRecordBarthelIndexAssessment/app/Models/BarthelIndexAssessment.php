<?php

namespace Modules\MedicalRecordBarthelIndexAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordBarthelIndexAssessment\Database\Factories\BarthelIndexAssessmentFactory;

class BarthelIndexAssessment extends Model
{
    use HasFactory;

    protected $table = 'barthel_index_assessments';

    /**
     * Hitung total skor Barthel Index dari kesepuluh sub-itemnya.
     *
     * Skor DIHITUNG di sini, tidak diterima mentah dari klien. Barthel Index
     * dipakai menilai kemandirian ADL (activity of daily living) pasien — total
     * yang salah ketik bisa membuat pasien yang sebenarnya sangat tergantung
     * tercatat mandiri, atau sebaliknya, tanpa tanda apa pun di layar.
     *
     * Kesepuluh sub-item sudah dibatasi nilai sahnya oleh FormRequest
     * (feeding 0-10, bathing 0-5, grooming 0-5, dressing 0-10, bowel_control 0-10,
     * bladder_control 0-10, toilet_use 0-10, transfers 0-15, mobility 0-15,
     * stairs 0-10), jadi rentang total 0-100.
     *
     * CATATAN: kolom `interpretation` di skema ini adalah string bebas (nullable,
     * max:30), BUKAN enum baku. Karena ambang kategorinya tidak dikunci oleh
     * validasi yang ada, kolom ini TIDAK dihitung ulang di sini — hanya total_score.
     * Lihat laporan tugas untuk detail.
     */
    /**
     * Tingkat kemandirian menurut ambang baku Barthel Index (skor 0-100).
     *
     * ARAHNYA KEBALIKAN dari skala risiko seperti Morse: pada Barthel skor
     * TINGGI berarti pasien LEBIH MANDIRI. Salah arah di sini akan menandai
     * pasien mandiri sebagai ketergantungan total, dan sebaliknya.
     *
     * Pita yang dipakai adalah pembagian Barthel yang paling umum dipakai di
     * praktik klinis Indonesia:
     *   0-20 total, 21-61 berat, 62-90 sedang, 91-99 ringan, 100 mandiri
     *
     * Label dijaga <= 30 karakter mengikuti batas kolom.
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
            + (int) ($items['grooming'] ?? 0)
            + (int) ($items['dressing'] ?? 0)
            + (int) ($items['bowel_control'] ?? 0)
            + (int) ($items['bladder_control'] ?? 0)
            + (int) ($items['toilet_use'] ?? 0)
            + (int) ($items['transfers'] ?? 0)
            + (int) ($items['mobility'] ?? 0)
            + (int) ($items['stairs'] ?? 0);
    }

    protected $fillable = [
        'visit_id',
        'feeding',
        'bathing',
        'grooming',
        'dressing',
        'bowel_control',
        'bladder_control',
        'toilet_use',
        'transfers',
        'mobility',
        'stairs',
        'total_score',
        'interpretation',
        'assessed_at',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): BarthelIndexAssessmentFactory
    {
        return BarthelIndexAssessmentFactory::new();
    }
}
