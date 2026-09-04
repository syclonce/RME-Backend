<?php

namespace Modules\LayananRadiologyResult\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\LayananRadiologyOrder\Models\RadiologyOrder;
use Modules\LayananRadiologyResult\Database\Factories\RadiologyResultFactory;

class RadiologyResult extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $table = 'radiology_results';

    public const STATUSS = ['pending', 'final'];

    protected $fillable = [
        'radiology_order_id',
        // Diserap dari ImagingStudy (keputusan pemilik repo 2026-09-04):
        // study_instance_uid & report_url tidak sepadan dengan kolom yang
        // sudah ada di sini, jadi ditambah lewat migrasi, bukan entitas
        // ImagingStudy terpisah. performed_at/findings_summary ImagingStudy
        // TIDAK diserap karena sudah tertampung examined_at/findings di bawah.
        'study_instance_uid',
        'findings',
        'impression',
        'report_url',
        'radiologist_id',
        'examined_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'examined_at' => 'datetime',
        ];
    }

    public function radiologyOrder(): BelongsTo
    {
        return $this->belongsTo(RadiologyOrder::class, 'radiology_order_id');
    }

    public function radiologist(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'radiologist_id');
    }

    protected static function newFactory(): RadiologyResultFactory
    {
        return RadiologyResultFactory::new();
    }
}
