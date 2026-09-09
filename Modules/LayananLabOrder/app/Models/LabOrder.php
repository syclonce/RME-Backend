<?php

namespace Modules\LayananLabOrder\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananLabOrder\Database\Factories\LabOrderFactory;
use Modules\LayananLabResult\Models\LabResult;
use Modules\PendaftaranVisit\Models\Visit;

class LabOrder extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'order_number',
        'visit_id',
        'ordered_by',
        'ordered_at',
        'destination',
        'is_emergency',
        'reason',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'ordered_at' => 'datetime',
            'is_emergency' => 'boolean',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function orderedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'ordered_by');
    }

    public function results(): HasMany
    {
        return $this->hasMany(LabResult::class);
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateOrderNumber(): string
    {
        return NumberSequence::format('LAB', 'lab_order', now()->format('Y'));
    }

    protected static function newFactory(): LabOrderFactory
    {
        return LabOrderFactory::new();
    }
}
