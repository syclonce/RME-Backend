<?php

namespace Modules\LayananRadiologyOrder\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\GeneralPatient\Models\Patient;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananRadiologyOrder\Database\Factories\RadiologyOrderFactory;

class RadiologyOrder extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $table = 'radiology_orders';

    // State machine gabungan (keputusan pemilik repo 2026-09-04, gabung
    // LayananImagingOrder ke sini): Radiology lama hanya punya
    // pending → in_progress → completed. Imaging lama punya
    // ordered → scheduled → completed. Digabung jadi
    // pending → scheduled → in_progress → completed, dengan 'scheduled'
    // sebagai sub-state OPSIONAL sebelum in_progress (order boleh langsung
    // pending → in_progress tanpa dijadwalkan dulu — lihat RadiologyOrderService::TRANSITIONS).
    // 'cancelled' adalah cabang dari pending/scheduled/in_progress, sama seperti
    // ImagingOrder. Existing RadiologyOrderItem & RadiologyResult hanya
    // memeriksa status 'completed'/'cancelled' sebagai terminal, jadi
    // penyisipan 'scheduled' di tengah TIDAK mengubah kontrak mereka.
    public const STATUSS = ['pending', 'scheduled', 'in_progress', 'completed', 'cancelled'];

    /**
     * Modality yang dikenali (diserap dari ImagingOrder::MODALITIES). Daftar
     * tertutup sengaja dipakai (bukan string bebas) supaya salah ketik seperti
     * "XRAY"/"x-ray" tidak menggagalkan pelaporan per modality.
     */
    public const MODALITIES = ['X-Ray', 'CT', 'MRI', 'USG'];

    protected $fillable = [
        'visit_id',
        'patient_id',
        'ordering_doctor_id',
        'modality',
        'body_part',
        'ordered_at',
        'scheduled_at',
        'clinical_notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'ordered_at' => 'datetime',
            'scheduled_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function orderingDoctor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'ordering_doctor_id');
    }

    protected static function newFactory(): RadiologyOrderFactory
    {
        return RadiologyOrderFactory::new();
    }
}
