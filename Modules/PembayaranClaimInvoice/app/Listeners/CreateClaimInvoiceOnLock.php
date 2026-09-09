<?php

namespace Modules\PembayaranClaimInvoice\Listeners;

use App\Events\InvoiceLocked;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;
use Modules\PendaftaranGuarantor\Models\Guarantor;

/**
 * Menutup rantai tagihan -> klaim yang selama ini terputus (audit: NOL
 * rujukan silang antara PembayaranClaimInvoice dan EKlaim, tidak ada yang
 * membuat klaim saat tagihan dikunci). Listener ini HANYA membuat draft klaim
 * internal - tidak ada panggilan E-Klaim eksternal (butuh kredensial, di luar
 * cakupan tugas ini).
 *
 * Pola registrasi/gaya mengikuti
 * Modules\FinanceGeneralLedger\Listeners\PostInvoiceLockedToLedger (listener
 * lain untuk event yang sama): baca $invoice->status/relasi, jangan campur
 * tangan alur transaksional InvoiceService.
 */
class CreateClaimInvoiceOnLock
{
    public function handle(InvoiceLocked $event): void
    {
        $invoice = $event->invoice;

        // Tagihan yang dibatalkan tidak pernah punya nilai ekonomis yang
        // perlu diklaimkan (sama seperti aturan PostInvoiceLockedToLedger).
        if ($invoice->status === 'cancelled') {
            return;
        }

        // Klaim hanya relevan untuk kunjungan berpenjamin (BPJS/asuransi/
        // korporat). Pasien umum (self_pay) TIDAK boleh menghasilkan klaim -
        // penjamin utama diambil dari lampiran dengan sequence terkecil
        // (port urutan KE simgos2: penjamin pertama = penanggung utama).
        $attachment = InvoiceGuarantor::query()
            ->where('invoice_id', $invoice->id)
            ->whereHas('guarantor', function ($query) {
                $query->where('payer_type', '!=', Guarantor::PAYER_SELF_PAY);
            })
            ->with('guarantor')
            ->orderBy('sequence')
            ->first();

        if ($attachment === null) {
            return;
        }

        // Idempoten: event InvoiceLocked bisa terpicu ulang (lock/markPaid/
        // cancel semua dispatch event yang sama - lihat komentar di
        // InvoiceLocked/PostInvoiceLockedToLedger). Satu invoice hanya boleh
        // punya satu ClaimInvoice; tanpa guard ini, markPaid setelah lock
        // akan membuat draft klaim duplikat.
        $alreadyClaimed = ClaimInvoice::query()
            ->where('invoice_id', $invoice->id)
            ->exists();

        if ($alreadyClaimed) {
            return;
        }

        ClaimInvoice::create([
            'claim_number' => ClaimInvoice::generateClaimNumber(),
            'invoice_id' => $invoice->id,
            'guarantor_id' => $attachment->guarantor_id,
            // Nilai klaim awal = porsi yang ditanggung penjamin utama pada
            // lampiran tagihan (covered_amount), bukan total_amount invoice -
            // pasien tetap bisa punya porsi mandiri di luar tanggungan
            // penjamin (lihat Invoice::getPatientShareAttribute).
            'claim_amount' => $attachment->covered_amount,
            'verified_amount' => null,
            'submitted_at' => null,
            'status' => 'draft',
            'rejection_reason' => null,
        ]);
    }
}
