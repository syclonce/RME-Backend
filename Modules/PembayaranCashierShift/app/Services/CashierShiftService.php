<?php

namespace Modules\PembayaranCashierShift\Services;

use App\Modules\Contracts\CashierShiftGate;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\PembayaranCashier\Models\Cashier;
use Modules\PembayaranCashierShift\Models\CashierShift;
use Modules\PembayaranCashierTransaction\Models\CashierTransaction;
use Modules\PembayaranPayment\Models\Payment;

class CashierShiftService implements CashierShiftGate
{
    public function open(Cashier $cashier, User $user, float $initialCash): CashierShift
    {
        abort_unless($cashier->is_active, 422, 'Kasir tidak aktif.');
        $this->assertOperator($cashier, $user);

        return DB::transaction(function () use ($cashier, $user, $initialCash) {
            Cashier::query()->whereKey($cashier->id)->lockForUpdate()->firstOrFail();
            abort_if(CashierShift::query()->where('cashier_id', $cashier->id)->where('status', 'open')->exists(), 422, 'Kasir masih memiliki shift terbuka.');

            return CashierShift::create([
                'cashier_id' => $cashier->id,
                'opened_by' => $user->id,
                'opened_at' => now(),
                'initial_cash' => $initialCash,
                'status' => CashierShift::STATUS_OPEN,
            ]);
        });
    }

    public function assertOpen(int $shiftId, User $user): int
    {
        $shift = CashierShift::query()->findOrFail($shiftId);
        abort_unless($shift->status === CashierShift::STATUS_OPEN, 422, 'Shift kasir sudah ditutup.');
        $cashier = Cashier::query()->findOrFail($shift->cashier_id);
        $this->assertOperator($cashier, $user);

        return (int) $cashier->id;
    }

    public function close(CashierShift $shift, User $user, float $actualCash, ?string $notes): CashierShift
    {
        $this->assertOpen($shift->id, $user);

        return DB::transaction(function () use ($shift, $user, $actualCash, $notes) {
            $locked = CashierShift::query()->whereKey($shift->id)->lockForUpdate()->firstOrFail();
            abort_unless($locked->status === CashierShift::STATUS_OPEN, 422, 'Shift kasir sudah ditutup.');

            $totals = Payment::query()->where('cashier_shift_id', $locked->id)->where('status', 'completed')
                ->selectRaw('payment_method, SUM(amount) AS total')->groupBy('payment_method')
                ->pluck('total', 'payment_method')->map(fn ($value) => (float) $value)->all();
            $cashAdjustments = (float) CashierTransaction::query()->where('cashier_shift_id', $locked->id)
                ->selectRaw("SUM(CASE WHEN transaction_type = 'in' THEN amount ELSE -amount END) AS net")
                ->value('net');
            $expected = (float) $locked->initial_cash + ($totals['cash'] ?? 0.0) + $cashAdjustments;

            $locked->update([
                'status' => CashierShift::STATUS_CLOSED,
                'closed_at' => now(), 'closed_by' => $user->id,
                'expected_cash' => $expected, 'actual_cash' => $actualCash,
                'cash_variance' => $actualCash - $expected,
                'payment_totals' => $totals, 'closing_notes' => $notes,
            ]);

            return $locked->refresh();
        });
    }

    protected function assertOperator(Cashier $cashier, User $user): void
    {
        if ($user->hasRole('admin')) {
            return;
        }
        abort_unless(
            DB::table('employees')->where('id', $cashier->employee_id)->where('user_id', $user->id)->exists(),
            403,
            'Kasir ini tidak terhubung dengan akun Anda.',
        );
    }
}
