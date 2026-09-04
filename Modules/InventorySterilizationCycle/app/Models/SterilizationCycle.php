<?php

namespace Modules\InventorySterilizationCycle\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\InventorySterilizationCycle\Database\Factories\SterilizationCycleFactory;

/**
 * Satu siklus sterilisasi mesin CSSD (autoklaf dsb). status & biological_indicator_result
 * adalah gerbang untuk SterilizedItem::create — hanya cycle status=passed DAN
 * biological_indicator_result=negative yang boleh menghasilkan item steril
 * (lihat Modules\InventorySterilizationCycle\Services\SterilizedItemService).
 */
class SterilizationCycle extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_IN_PROCESS = 'in_process';

    public const STATUS_PASSED = 'passed';

    public const STATUS_FAILED = 'failed';

    public const BI_PENDING = 'pending';

    public const BI_NEGATIVE = 'negative';

    public const BI_POSITIVE = 'positive';

    protected $fillable = [
        'cycle_number',
        'machine_name',
        'temperature_celsius',
        'pressure_bar',
        'duration_minutes',
        'started_at',
        'completed_at',
        'biological_indicator_result',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'temperature_celsius' => 'decimal:2',
            'pressure_bar' => 'decimal:2',
            'duration_minutes' => 'integer',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function sterilizedItems(): HasMany
    {
        return $this->hasMany(SterilizedItem::class, 'cycle_id');
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateCycleNumber(): string
    {
        return NumberSequence::format('CYC', 'sterilization_cycle', now()->format('Y'));
    }

    protected static function newFactory(): SterilizationCycleFactory
    {
        return SterilizationCycleFactory::new();
    }
}
