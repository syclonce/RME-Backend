<?php

namespace Tests\Feature\Contracts;

use Tests\TestCase;

/**
 * Field uang dan jumlah tidak boleh menerima nilai negatif.
 *
 * Ditemukan lewat HTTP: `'amount' => ['required', 'numeric']` tanpa batas
 * bawah membuat
 *
 *     POST /api/v1/pharmacy-service-fees  {"amount": -500000}
 *
 * tersimpan sebagai biaya layanan −500.000. Bila biaya itu masuk tagihan, ia
 * MENGURANGI jumlah yang harus dibayar pasien.
 *
 * `amount` boleh nol (layanan gratis memang ada); `quantity` minimal satu —
 * memberi nol obat bukan transaksi, itu kekeliruan input.
 */
class MonetaryBoundsTest extends TestCase
{
    public function test_money_and_quantity_fields_have_a_lower_bound(): void
    {
        $offenders = [];

        foreach (glob(base_path('Modules/*/app/Http/Requests/*.php')) as $file) {
            $source = file_get_contents($file);

            foreach (['amount', 'quantity', 'unit_price', 'initial_cash', 'actual_cash'] as $field) {
                if (preg_match("/'{$field}' => \[[^\]]*\]/", $source, $match)
                    && preg_match("/'(numeric|integer)'/", $match[0])
                    && ! str_contains($match[0], 'min:')
                    && ! str_contains($match[0], 'gte:')) {
                    $offenders[] = str_replace(base_path().'/', '', $file)." ({$field})";
                }
            }
        }

        $this->assertSame(
            [],
            $offenders,
            "Field berikut menerima nilai negatif. Uang negatif yang masuk tagihan mengurangi "
            ."jumlah yang harus dibayar pasien:\n  ".implode("\n  ", $offenders),
        );
    }
}
