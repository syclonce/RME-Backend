<?php

namespace App\Modules\Contracts;

use Modules\Auth\Models\User;

interface CashierShiftGate
{
    /** Mengembalikan cashier_id bila shift terbuka dan dimiliki aktor. */
    public function assertOpen(int $shiftId, User $user): int;
}
