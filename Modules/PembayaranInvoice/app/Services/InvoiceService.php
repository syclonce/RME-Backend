<?php

namespace Modules\PembayaranInvoice\Services;

use App\Events\InvoiceLocked;
use App\Modules\Contracts\BillingGate;
use App\Modules\Contracts\ServiceEpisodeGate;
use Illuminate\Support\Facades\DB;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;
use Modules\PembayaranInvoiceItem\Models\InvoiceItem;
use Modules\PembayaranInvoiceCancellation\Models\InvoiceCancellation;
use Modules\PembayaranPayment\Models\Payment;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\PendaftaranVisit\Models\Visit;

/**
 * Domain service mesin tagihan — port rutin `pembayaran.*` simgos2 ke kode
 * Laravel testable (aslinya stored procedure MySQL).
 *
 * Yang di-port di tahap ini (#9):
 * - buatTagihan            → ensureForVisit()
 * - storePenjaminTagihan   → attachGuarantor() (lampiran idempoten, sequence ala KE)
 * - reProsesDistribusiTarif→ redistribute() (reset-then-recompute)
 * - getTotalPenjaminTagihan→ coverage() / Invoice::coveredAmount()
 * - STATUS=2 final         → lock()/unlock() + event InvoiceLocked
 *
 * Bucket agregasi INACBG & mesin naik-kelas prosesPerhitunganBPJS sengaja
 * disingkat: itu concern pengajuan klaim BPJS yang bergantung hasil_grouping,
 * bukan core billing (lihat komentar migrasi invoice_items).
 */
class InvoiceService implements BillingGate
{
    public function __construct(protected ServiceEpisodeGate $serviceEpisodeGate) {}

    /**
     * Gerbang locked SELALU membaca state DB (bukan atribut instance yang
     * mungkin basi di proses long-running), ala SP simgos2 yang membaca
     * tabel langsung - sekaligus menutup race dengan lock dari request lain.
     */
    protected function isInvoiceLocked(int $invoiceId): bool
    {
        return Invoice::query()->whereKey($invoiceId)->where('is_locked', true)->exists();
    }

    /**
     * Total uang tunai/non-tunai yang sudah diterima untuk satu invoice.
     * Pembayaran adalah catatan kas append-only: selama masih ada barisnya,
     * invoice tidak boleh dihapus karena FK cascadeOnDelete akan ikut
     * menghancurkan bukti penerimaan uang.
     */
    protected function collectedAmount(int $invoiceId): float
    {
        return (float) Payment::query()->where('invoice_id', $invoiceId)
            ->where('status', 'completed')->sum('amount');
    }

    /**
     * Kunci invoice (kasir menutup pembayaran). Ala config 69 simgos2:
     * setelah terkunci, tidak ada posting layanan baru ke kunjungan tsb.
     */
    public function lock(int $invoiceId): void
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $this->serviceEpisodeGate->assertFinalized((int) $invoice->visit_id);

        DB::transaction(function () use ($invoiceId) {
            $locked = Invoice::query()->whereKey($invoiceId)->lockForUpdate()->firstOrFail();
            abort_if($locked->status === 'cancelled', 422, 'Invoice batal tidak dapat difinalkan.');
            $locked->update(['is_locked' => true]);
        });

        // Event di luar transaksi: listener hanya boleh menyentuh data yang
        // sudah commit (efek samping non-kritis; audit menyusul #12).
        $cancelled = Invoice::findOrFail($invoiceId);

        InvoiceLocked::dispatch($cancelled->refresh());
    }

    /**
     * Tandai invoice lunas + terkunci (dipakai modul PembayaranPayment begitu
     * total pembayaran >= total_amount). Lewat jalur resmi supaya event
     * InvoiceLocked (audit trail invoice_lock) tetap terpicu -- sebelumnya
     * PaymentController menulis $invoice->update() langsung, jejak audit
     * pelunasan otomatis jadi tidak pernah tercatat (ditemukan lewat uji
     * end-to-end HTTP, bukan asumsi).
     */
    public function markPaid(int $invoiceId): void
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $this->serviceEpisodeGate->assertFinalized((int) $invoice->visit_id);

        DB::transaction(function () use ($invoice) {
            $invoice->update(['status' => 'paid', 'is_locked' => true]);
        });

        $cancelled = Invoice::findOrFail($invoiceId);

        InvoiceLocked::dispatch($cancelled->refresh());
    }

    /**
     * Batalkan invoice (dipakai modul PembayaranInvoiceCancellation, catatan
     * legal/finansial append-only). Statusnya jadi 'cancelled' + terkunci
     * sekaligus, lewat jalur resmi supaya event InvoiceLocked tetap terpicu
     * (audit trail invoice_lock) -- bukan raw update dari controller lain.
     *
     * Gerbang duplikat + paid dipindah ke sini (regresi vuln-0017): satu
     * invoice hanya boleh punya SATU baris pembatalan, dan invoice 'paid'
     * tidak boleh dibatalkan lewat jalur ini. Keduanya dicek dalam transaksi
     * yang sama dengan lockForUpdate supaya request paralel tidak lolos
     * berdua, dan dispatch InvoiceLocked tetap SETELAH commit dengan model
     * hasil refresh -- satu-satunya jalur kunci tagihan agar listener audit
     * selalu membaca state yang sudah konsisten.
     */
    public function cancel(int $invoiceId): void
    {
        DB::transaction(function () use ($invoiceId) {
            $invoice = Invoice::query()->whereKey($invoiceId)->lockForUpdate()->firstOrFail();

            abort_if(
                InvoiceCancellation::query()->where('invoice_id', $invoice->id)->exists(),
                422,
                'Invoice ini sudah pernah dibatalkan.',
            );

            abort_if(
                $invoice->status === 'paid',
                422,
                'Invoice yang sudah dibayar tidak dapat langsung dibatalkan; gunakan alur refund/pembatalan pembayaran.',
            );

            // Port PembatalanTagihanResource:30 simgos2 (sudahKlaim): tagihan
            // yang sudah diajukan ke penjamin tidak boleh dibatalkan diam-diam
            // — klaim yang terlanjur jalan harus direkonsiliasi dulu. Draft dan
            // rejected bukan klaim berjalan (belum/sudah dikembalikan), jadi
            // tidak menghalangi.
            abort_if(
                ClaimFile::query()
                    ->where('invoice_id', $invoice->id)
                    ->whereNotIn('status', [ClaimFile::STATUS_DRAFT, ClaimFile::STATUS_REJECTED])
                    ->exists(),
                422,
                'Invoice ini sudah masuk proses klaim; batalkan/tarik kembali berkas klaimnya terlebih dahulu.',
            );

            $invoice->update(['status' => 'cancelled', 'is_locked' => true]);
        });

        // Dispatch SETELAH commit TERLUAR: cancel() bisa dipanggil dari dalam
        // transaksi pemanggil (mis. controller PembayaranInvoiceCancellation
        // membungkus cancel + pencatatan baris pembatalan jadi satu unit
        // atomik). Listener audit tidak boleh membaca state yang belum commit,
        // dan kalau transaksi pembungkus di-rollback, event ini tidak boleh
        // terpicu sama sekali.
        DB::afterCommit(function () use ($invoiceId) {
            InvoiceLocked::dispatch(Invoice::query()->findOrFail($invoiceId));
        });
    }

    /**
     * Buka kunci untuk koreksi (admin only di route). Port legacy
     * TagihanResource:157 — buka-kunci setelah final dilarang. Di SIMGOS
     * 'final' = status paid/cancelled: paid hanya lewat reversal/refund,
     * cancelled tidak pernah dibuka (audit append-only).
     */
    public function unlock(int $invoiceId): void
    {
        DB::transaction(function () use ($invoiceId) {
            $invoice = Invoice::query()->whereKey($invoiceId)->lockForUpdate()->firstOrFail();
            abort_if($invoice->status === 'paid', 422, 'Invoice lunas tidak dapat dibuka kuncinya; gunakan alur reversal/refund.');
            abort_if($invoice->status === 'cancelled', 422, 'Invoice batal tidak dapat dibuka kuncinya.');
            $invoice->update(['is_locked' => false]);
        });
    }

    public function reopenAfterReversal(int $invoiceId): void
    {
        $invoice = Invoice::query()->whereKey($invoiceId)->lockForUpdate()->firstOrFail();
        abort_if($invoice->status === 'cancelled', 422, 'Invoice batal tidak dapat dibuka kembali.');
        $invoice->update(['status' => 'open', 'is_locked' => false]);
    }

    /**
     * TRUE bila ada invoice kunjungan ini yang is_locked=true.
     * Dipanggil gerbang admission/service lain via App\Modules\Contracts\BillingGate.
     */
    public function isVisitLocked(int $visitId): bool
    {
        return Invoice::query()
            ->where('visit_id', $visitId)
            ->where('is_locked', true)
            ->exists();
    }

    /**
     * Port pembayaran.buatTagihan: get-or-create satu invoice terbuka untuk
     * kunjungan. RME menyederhanakan model multi-pendaftaran simgos2 menjadi
     * 1 invoice : 1 kunjungan.
     */
    public function ensureForVisit(int $visitId): Invoice
    {
        Visit::findOrFail($visitId);

        $invoice = Invoice::query()->firstOrCreate(
            ['visit_id' => $visitId],
            [
                'invoice_number' => Invoice::generateInvoiceNumber(),
                'invoice_date' => now(),
            ],
        );

        return $invoice->refresh();
    }

    /**
     * Port dari store() controller: buka invoice untuk kunjungan lewat
     * ensureForVisit (get-or-create, invarian 1 invoice : 1 kunjungan) dan,
     * HANYA saat baris memang baru dibuat, terapkan atribut opsional dari
     * request (nomor/tanggal manual, rounding_adjustment awal). Invoice yang
     * sudah ada untuk kunjungan ini tidak pernah ditimpa lewat jalur ini -
     * mencegah request store() kedua diam-diam mengubah invoice pertama.
     */
    public function createForVisit(int $visitId, array $attributes, int $createdBy): Invoice
    {
        Visit::findOrFail($visitId);

        $invoice = Invoice::query()->firstOrCreate(
            ['visit_id' => $visitId],
            array_merge([
                'invoice_number' => Invoice::generateInvoiceNumber(),
                'invoice_date' => now(),
                'created_by' => $createdBy,
            ], $attributes),
        );

        if ($invoice->wasRecentlyCreated && array_key_exists('rounding_adjustment', $attributes)) {
            $invoice->recalculateTotals();
        }

        return $invoice->refresh();
    }

    /**
     * Update atribut invoice terbuka (nomor, tanggal, rounding_adjustment,
     * status) lalu jaga dua invarian yang sebelumnya hanya ditegakkan lewat
     * postServiceItem(): total_amount konsisten dengan rounding_adjustment
     * terbaru, dan coverage_amount penjamin (turunan total_amount) ikut
     * disinkronkan lewat redistribute().
     */
    public function updateInvoice(Invoice $invoice, array $data): Invoice
    {
        abort_if($this->isInvoiceLocked($invoice->id), 422, 'Tagihan ini sudah dikunci, tidak bisa diubah.');

        DB::transaction(function () use ($invoice, $data) {
            $invoice->update($data);
            $invoice->recalculateTotals();
        });

        $this->redistribute($invoice->refresh());

        return $invoice->refresh();
    }

    /**
     * Hapus invoice terbuka dalam transaksi, ikut membuang baris item &
     * lampiran penjamin (FK sudah cascadeOnDelete, eksplisit di sini biar
     * jelas untuk pembaca & konsisten dengan pola service lain di kelas ini).
     */
    public function deleteInvoice(Invoice $invoice): void
    {
        abort_if($this->isInvoiceLocked($invoice->id), 422, 'Tagihan ini sudah dikunci, tidak bisa dihapus.');

        abort_if(
            $this->collectedAmount($invoice->id) > 0,
            422,
            'Tagihan sudah memiliki pembayaran tercatat dan tidak bisa dihapus. Gunakan jalur pembatalan tagihan.',
        );

        DB::transaction(function () use ($invoice) {
            $invoice->guarantorAttachments()->delete();
            $invoice->items()->delete();
            $invoice->delete();
        });
    }

    /**
     * Port pembayaran.storePenjaminTagihan: lampirkan penjamin ke invoice,
     * idempoten (satu penjamin satu baris), sequence berurutan ala KE -
     * sequence 1 adalah penanggung utama (ala farmasi simgos2 yang membaca KE=1).
     *
     * @throws HttpException bila invoice terkunci.
     */
    public function attachGuarantor(Invoice $invoice, int $guarantorId, ?int $roomClassId = null): InvoiceGuarantor
    {
        // Pola gerbang #7 (VisitService::abort_if): pesan JSON {"message": ...}.
        abort_if($this->isInvoiceLocked($invoice->id), 422, 'Tagihan sudah dikunci, distribusi penjamin tidak bisa diubah.');

        $guarantor = Guarantor::query()->findOrFail($guarantorId);

        return DB::transaction(function () use ($invoice, $guarantor, $roomClassId) {
            $existing = InvoiceGuarantor::query()
                ->where('invoice_id', $invoice->id)
                ->where('guarantor_id', $guarantor->id)
                ->first();

            if ($existing !== null) {
                return $existing;
            }

            // Ala SELECT MAX(KE)+1: urutan lanjutan penjamin pada invoice ini.
            $nextSequence = (int) InvoiceGuarantor::query()
                ->where('invoice_id', $invoice->id)
                ->max('sequence') + 1;

            return InvoiceGuarantor::create([
                'invoice_id' => $invoice->id,
                'guarantor_id' => $guarantor->id,
                'sequence' => $nextSequence,
                'covered_amount' => 0,
                'room_class_id' => $roomClassId ?? $guarantor->room_class_id,
            ]);
        });
    }

    /**
     * Port pembayaran.reProsesDistribusiTarif: hitung ulang distribusi dari nol
     * (reset-then-recompute), idempoten.
     *
     * Sumber baris = guarantor AKTIF milik registration kunjungan, urut id agar
     * deterministik. Aturan tanggungan versi inti: penjamin non-self_pay PERTAMA
     * menanggung seluruh total (ala TOTAL BPJS = nilai klaim); tanpa penjamin
     * non-self_pay seluruh tagihan menjadi tanggungan pasien (covered 0).
     */
    public function redistribute(Invoice $invoice): void
    {
        abort_if($this->isInvoiceLocked($invoice->id), 422, 'Tagihan sudah dikunci, distribusi penjamin tidak bisa diubah.');

        $visit = $invoice->visit()->firstOrFail();

        $activeGuarantors = Guarantor::query()
            ->where('registration_id', $visit->registration_id)
            ->where('status', 'active')
            ->orderBy('id')
            ->get();

        DB::transaction(function () use ($invoice, $activeGuarantors) {
            // RESET: sinkronkan baris lampiran dengan daftar guarantor aktif.
            $attachments = collect();
            foreach ($activeGuarantors as $index => $guarantor) {
                $attachments[] = InvoiceGuarantor::query()->updateOrCreate(
                    ['invoice_id' => $invoice->id, 'guarantor_id' => $guarantor->id],
                    ['sequence' => $index + 1, 'room_class_id' => $guarantor->room_class_id],
                );
            }

            // Baris lampiran milik guarantor yang sudah tidak aktif ikut dibuang.
            InvoiceGuarantor::query()
                ->where('invoice_id', $invoice->id)
                ->when($activeGuarantors->isNotEmpty(), fn ($q) => $q->whereNotIn('guarantor_id', $activeGuarantors->pluck('id')))
                ->delete();

            // RECOMPUTE: penjamin non-self_pay pertama menanggung penuh.
            $payer = $attachments->first(fn (InvoiceGuarantor $a) => $a->guarantor->payer_type !== 'self_pay');

            foreach ($attachments as $attachment) {
                $attachment->update([
                    'covered_amount' => $attachment->is($payer) ? $invoice->total_amount : 0,
                ]);
            }
        });
    }

    /**
     * Port pembayaran.getTotalPenjaminTagihan + selisihnya: ringkasan siapa
     * menanggung apa. patient_share selalu dihitung, tidak pernah disimpan.
     *
     * @return array{total: string, covered: string, patient_share: string}
     */
    public function coverage(Invoice $invoice): array
    {
        return [
            'total' => number_format((float) $invoice->total_amount, 2, '.', ''),
            'covered' => $invoice->coveredAmount(),
            'patient_share' => $invoice->patient_share,
        ];
    }

    /**
     * Recalculate subtotal/total invoice dalam transaksi (reuse
     * Invoice::recalculateTotals). Dipakai setelah posting item.
     */
    public function recalculate(Invoice $invoice): Invoice
    {
        return DB::transaction(function () use ($invoice) {
            $invoice->recalculateTotals();

            return $invoice->refresh();
        });
    }

    /**
     * Port pembayaran.storeRincianTagihan untuk modul klinis (farmasi, lab,
     * radiologi nanti): posting satu baris layanan ke invoice kunjungan via
     * kontrak BillingGate - get-or-create invoice, tambah item, recalculate,
     * lalu redistribute penjamin agar coverage tetap konsisten.
     *
     * @throws HttpException bila tagihan terkunci.
     */
    public function postServiceItem(int $visitId, string $description, ?string $category, int $quantity, float $unitPrice, ?int $wardId = null): void
    {
        $invoice = $this->ensureForVisit($visitId);

        abort_if($this->isInvoiceLocked($invoice->id), 422, 'Tagihan sudah dikunci, posting layanan baru ditolak.');

        DB::transaction(function () use ($invoice, $description, $category, $quantity, $unitPrice, $wardId) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                // Unit pengerja disimpan per baris — inilah yang membuat pendapatan
                // dapat dipecah per unit tanpa menerbitkan kunjungan baru tiap
                // pasien berpindah (keputusan 2026-09-04).
                'ward_id' => $wardId,
                'description' => $description,
                'category' => $category,
                'quantity' => max(1, $quantity),
                'unit_price' => $unitPrice,
                'subtotal' => round(max(1, $quantity) * $unitPrice, 2),
            ]);

            $invoice->recalculateTotals();
        });

        // Coverage penjamin dihitung ulang atas total terbaru.
        $this->redistribute($invoice);
    }
}
