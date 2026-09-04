<?php

namespace Modules\PembayaranPayment\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Model;
use Modules\AuditActivityLog\Support\Auditable;

class PaymentReversal extends Model
{
    use Auditable, HydratesDatabaseDefaults;

    protected $fillable = [
        'payment_id', 'cashier_shift_id', 'reason', 'reversed_by', 'reversed_at',
    ];

    protected function casts(): array
    {
        return ['reversed_at' => 'datetime'];
    }
}
