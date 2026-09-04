<?php

namespace Modules\PenjualanSale\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\PenjualanSale\Models\Sale;

/**
 * State machine penjualan langsung/retail (pola sama dengan
 * LabOrderService::TRANSITIONS + lockForUpdate + cek status dua kali).
 *
 * Penjualan tidak terikat kunjungan (walk-in dimungkinkan tanpa visit_id),
 * karena itu tidak melewati BillingGate seperti modul pembayaran/kunjungan
 * lain - jual-beli retail ini di luar siklus tagihan kunjungan RME.
 */
class SaleService
{
    private const TRANSITIONS = [
        'completed' => ['void', 'refunded'],
        'void' => [],
        'refunded' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): Sale
    {
        return DB::transaction(fn () => Sale::create([
            ...Arr::except($data, 'status'),
            'sale_number' => $data['sale_number'] ?? Sale::generateSaleNumber(),
            'sold_at' => $data['sold_at'] ?? now(),
            'status' => 'completed',
        ]));
    }

    public function transition(Sale $sale, string $target): Sale
    {
        $allowed = self::TRANSITIONS[$sale->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi penjualan {$sale->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($sale, $target) {
            $locked = Sale::query()->whereKey($sale->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status penjualan sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
