<?php

namespace Modules\PenjualanSale\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PenjualanSale\Database\Factories\SaleFactory;
use Modules\PenjualanSaleItem\Models\SaleItem;

class Sale extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'sale_number',
        'patient_id',
        'sold_by',
        'sold_at',
        'total_amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'sold_at' => 'datetime',
            'total_amount' => 'decimal:2',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function soldBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'sold_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateSaleNumber(): string
    {
        return NumberSequence::format('SAL', 'sale', now()->format('Y'));
    }

    protected static function newFactory(): SaleFactory
    {
        return SaleFactory::new();
    }
}
