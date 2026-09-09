<?php

namespace Modules\LayananMedicineDelivery\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananMedicineDelivery\Database\Factories\MedicineDeliveryFactory;
use Modules\LayananPharmacyDispense\Models\PharmacyDispense;

class MedicineDelivery extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $table = 'medicine_deliveries';

    public const STATUS_PENDING = 'pending';

    public const STATUS_DIKIRIM = 'dikirim';

    public const STATUS_DITERIMA = 'diterima';

    public const STATUS_GAGAL = 'gagal';

    /** @var list<string> */
    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_DIKIRIM,
        self::STATUS_DITERIMA,
        self::STATUS_GAGAL,
    ];

    /**
     * Status penutup: pengantaran sudah selesai (berhasil atau gagal),
     * tidak bisa ditugaskan ulang, diedit, atau dihapus.
     *
     * @var list<string>
     */
    public const CLOSED_STATUSES = [
        self::STATUS_DITERIMA,
        self::STATUS_GAGAL,
    ];

    protected $fillable = [
        'pharmacy_dispense_id',
        'patient_address',
        'courier_employee_id',
        'status',
        'requested_at',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    public function pharmacyDispense(): BelongsTo
    {
        return $this->belongsTo(PharmacyDispense::class, 'pharmacy_dispense_id');
    }

    public function courierEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'courier_employee_id');
    }

    protected static function newFactory(): MedicineDeliveryFactory
    {
        return MedicineDeliveryFactory::new();
    }
}
