<?php

namespace App\Modules\Contracts;

/**
 * Kontrak gerbang tagihan lintas modul.
 *
 * Port filosofi simgos2: modul klinis (Pendaftaran, Farmasi, dsb.) TIDAK boleh
 * menyentuh tabel invoice langsung; mereka bertanya lewat kontrak ini apakah
 * kunjungan terkait sudah terkunci oleh pembayaran (kasir sudah menutup tagihan).
 *
 * Implementasi: Modules\PembayaranInvoice\App\Services\InvoiceService.
 */
interface BillingGate
{
    /**
     * Apakah seluruh tagihan kunjungan ini terkunci (tidak boleh ada posting baru)?
     */
    public function isVisitLocked(int $visitId): bool;

    /**
     * Kunci invoice aktif milik kunjungan (dipanggil kasir saat menutup).
     */
    public function lock(int $invoiceId): void;

    /**
     * Buka kembali invoice (mis. retur/pembatalan yang disetujui).
     */
    public function unlock(int $invoiceId): void;

    /** Buka tagihan menjadi open setelah reversal membuatnya kurang bayar. */
    public function reopenAfterReversal(int $invoiceId): void;

    /**
     * Posting satu baris layanan ke invoice kunjungan (port
     * pembayaran.storeRincianTagihan simgos2): get-or-create invoice,
     * tambah item, recalculate, lalu redistribute penjamin.
     *
     * @param  string|null  $category  kategori billing, mis. 'medicine'|'procedure'
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException bila tagihan terkunci
     */
    /**
     * @param  int|null  $wardId  unit pengerja baris ini. Opsional agar pemanggil
     *                            lama tetap sah; diisi supaya pendapatan dapat
     *                            dilaporkan per unit tanpa memecah kunjungan.
     */
    public function postServiceItem(int $visitId, string $description, ?string $category, int $quantity, float $unitPrice, ?int $wardId = null): void;
}
