<?php

namespace Modules\PembayaranCashierShift\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\PembayaranCashierShift\Database\Factories\CashierShiftFactory;

class CashierShift extends Model
{
    use Auditable, HasFactory, HydratesDatabaseDefaults;

    public const STATUS_OPEN = 'open';
    public const STATUS_CLOSED = 'closed';

    protected $fillable = [
        'cashier_id', 'opened_by', 'opened_at', 'initial_cash', 'status',
        'closed_at', 'closed_by', 'expected_cash', 'actual_cash',
        'cash_variance', 'payment_totals', 'closing_notes',
    ];

    protected function casts(): array
    {
        return [
            'opened_at' => 'datetime', 'closed_at' => 'datetime',
            'initial_cash' => 'decimal:2', 'expected_cash' => 'decimal:2',
            'actual_cash' => 'decimal:2', 'cash_variance' => 'decimal:2',
            'payment_totals' => 'array',
        ];
    }

    protected static function newFactory(): CashierShiftFactory
    {
        return CashierShiftFactory::new();
    }
}
