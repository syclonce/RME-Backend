<?php

namespace Modules\PembayaranDeposit\Services;

use App\Modules\Contracts\BillingGate;
use App\Modules\Contracts\HospitalConfig;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\PembayaranDeposit\Models\Deposit;

/**
 * State machine deposit (pola sama dengan LabOrderService::TRANSITIONS +
 * lockForUpdate + cek status dua kali).
 *
 * PENTING: 'refunded' SENGAJA tidak ada di TRANSITIONS di sini. Refund
 * hanya boleh lewat Modules\PembayaranDepositRefund\Http\Controllers\DepositRefundController
 * agar tercipta baris DepositRefund yang tunduk pada batas kumulatif -
 * bukan flip status tanpa catatan akuntansi. Satu-satunya transisi yang
 * disediakan service ini adalah held->applied.
 */
class DepositService
{
    private const TRANSITIONS = [
        'held' => ['applied'],
        'applied' => [],
        'refunded' => [],
    ];

    public function __construct(
        protected BillingGate $billingGate,
        protected HospitalConfig $config,
    ) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): Deposit
    {
        // Port gerbang "tagihan terkunci kasir" simgos2 (pola sama dengan
        // PrescriptionService::create) - deposit baru tidak boleh dibuat atas
        // kunjungan yang tagihannya sudah dikunci kasir.
        abort_if(
            $this->config->get('billing.lock_on_cashier_close', true)
                && $this->billingGate->isVisitLocked((int) $data['visit_id']),
            422,
            'Tagihan kunjungan ini sudah dikunci kasir; deposit baru tidak dapat dibuat.',
        );

        // Jumlah deposit adalah jangkar batas refund kumulatif. Petugas tidak
        // boleh menetapkannya di atas plafon wajar tanpa jejak persetujuan
        // admin (lihat Deposit::MAX_AMOUNT).
        abort_if(
            (float) $data['amount'] > Deposit::MAX_AMOUNT && ! $user->hasRole('admin'),
            422,
            'Jumlah deposit melebihi plafon wajar; hanya admin yang dapat menyetujuinya.'
        );

        return DB::transaction(fn () => Deposit::create([
            ...Arr::except($data, 'status'),
            'deposit_number' => $data['deposit_number'] ?? Deposit::generateDepositNumber(),
            'paid_at' => $data['paid_at'] ?? now(),
            'received_by' => $user->id,
            'status' => 'held',
        ]));
    }

    public function transition(Deposit $deposit, string $target): Deposit
    {
        $allowed = self::TRANSITIONS[$deposit->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi deposit {$deposit->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($deposit, $target) {
            $locked = Deposit::query()->whereKey($deposit->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status deposit sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
