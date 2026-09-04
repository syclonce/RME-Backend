<?php

namespace Modules\LayananCriticalLabValue\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\LayananLabOrder\Models\LabOrder;
use Modules\Auth\Models\User;
use Modules\LayananCriticalLabValue\Database\Factories\CriticalLabValueFactory;

class CriticalLabValue extends Model
{
    use HasFactory;

    protected $table = 'critical_lab_values';

    protected $fillable = [
        'lab_order_id',
        'parameter_name',
        'critical_value',
        'notified_to',
        'notified_at',
        'notified_by',
        'acknowledged',
        'acknowledged_by',
        'acknowledged_at',
    ];

    protected function casts(): array
    {
        return [
            'notified_at' => 'datetime',
            'acknowledged' => 'boolean',
            'acknowledged_at' => 'datetime',
        ];
    }

    public function labOrder(): BelongsTo
    {
        return $this->belongsTo(LabOrder::class, 'lab_order_id');
    }

    public function notifiedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'notified_by');
    }

    public function acknowledgedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'acknowledged_by');
    }

    /**
     * Daftar kerja: nilai kritis yang sudah/belum diberitahukan tapi BELUM
     * diakui dokter. Ini yang seharusnya dipantau terus oleh perawat/dokter
     * jaga — nilai kritis yang "hilang" di sini adalah risiko keselamatan.
     */
    public function scopeUnacknowledged(Builder $query): Builder
    {
        return $query->where('acknowledged', false);
    }

    protected static function newFactory(): CriticalLabValueFactory
    {
        return CriticalLabValueFactory::new();
    }
}
