<?php

namespace Modules\PembayaranCashierShift\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\PembayaranCashier\Models\Cashier;
use Modules\PembayaranCashierShift\Models\CashierShift;

class CashierShiftFactory extends Factory
{
    protected $model = CashierShift::class;

    public function definition(): array
    {
        return [
            'cashier_id' => Cashier::factory(),
            'opened_by' => User::factory(),
            'opened_at' => now(),
            'initial_cash' => 500000,
            'status' => CashierShift::STATUS_OPEN,
        ];
    }
}
