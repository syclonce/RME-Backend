<?php

namespace Modules\LayananPharmacyDispense\Services;

use App\Events\PrescriptionDispensed;
use App\Modules\Contracts\BillingGate;
use App\Modules\Contracts\HospitalConfig;
use App\Modules\Contracts\StockGate;
use App\Modules\Contracts\VisitGate;
use App\Modules\Contracts\WardScope;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananPharmacyDispense\Models\PharmacyDispense;
use Modules\LayananPrescriptionInitialReview\Models\PrescriptionInitialReview;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PendaftaranVisit\Support\DerivedVisitFactory;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\GeneralWard\Models\Ward;

/**
 * Alur pelayanan farmasi end-to-end (port storeOrderResepDiFarmasi +
 * finalPelayananFarmasi simgos2, versi kode Laravel testable).
 *
 * Satu panggilan dispense() menjalankan gerbang berurutan ala simgos2:
 * status resep → telaah awal → restriksi penjamin → farmasi eksekutif →
 * stok; lalu efek: kurangi stok, catat dispense, posting tagihan via
 * BillingGate::postServiceItem, tandai resep terlayani, dispatch event
 * DI LUAR transaksi.
 */
class DispenseService
{
    public function __construct(
        protected StockGate $stock,
        protected BillingGate $billing,
        protected HospitalConfig $config,
        protected WardScope $wardScope,
        protected VisitGate $visitGate,
        protected DerivedVisitFactory $derivedVisits,
    ) {}

    public function dispense(Prescription $prescription, User $user): PharmacyDispense
    {
        // Data kunjungan untuk kedua gerbang akses di bawah.
        $visit = $prescription->visit()->first();

        // Gerbang least-privilege ward (#3 ANALISIS_RME_BACKEND.md): petugas
        // hanya boleh melayani resep pada kunjungan di ward tempat dia
        // ditugaskan. Admin selalu lolos; kunjungan tanpa ward selalu boleh.
        abort_if(
            ! $this->wardScope->canAccessWard($user, $visit?->ward_id),
            403,
            'Anda tidak ditugaskan pada ward kunjungan resep ini.',
        );

        // Gerbang status kunjungan: layanan tidak boleh diposting ke
        // kunjungan yang sudah pulang/batal (pasien sudah pulang).
        if ($visit !== null && ! $this->visitGate->isActive((int) $visit->id)) {
            abort(422, 'Kunjungan sudah pulang/batal; pelayanan resep tidak dapat dilanjutkan.');
        }

        // 1) Gerbang status resep: hanya resep hidup yang bisa dilayani,
        //    dan satu resep hanya sekali (port STATUS order_resep=2 di SP).
        abort_if(in_array($prescription->status, ['dispensed', 'cancelled'], true), 422, 'Resep sudah '.$prescription->status.' - tidak bisa dilayani lagi.');

        // 2) Gerbang telaah awal (config 54: telaah akhir wajib bersih).
        $this->assertScreeningPassed($prescription);

        // Data kunjungan & penjamin untuk gerbang 3-5.
        $visit = $prescription->visit()->firstOrFail();

        // 3) Gerbang restriksi penjamin (PropertiConfig 125 hidup):
        //    daftar payer_type yang dilarang melayani lewat resep biasa.
        $restrictedPayers = (array) $this->config->get('restriction.restricted_payers_prescription', []);
        if ($restrictedPayers !== []) {
            $terlarang = Guarantor::query()
                ->where('registration_id', $visit->registration_id)
                ->where('status', 'active')
                ->whereIn('payer_type', $restrictedPayers)
                ->exists();
            abort_if($terlarang, 422, 'Penjamin pasien direstriksi untuk pelayanan resep (aturan RS).');
        }

        // 4) Gerbang farmasi eksekutif (PropertiConfig 94/95): ruangan asal
        //    yang memakai depo eksekutif harus terdaftar di allowed_origins.
        $executiveRooms = (array) $this->config->get('pharmacy.executive_rooms', []);
        if ($executiveRooms !== [] && in_array($visit->ward_id, array_map(intval(...), $executiveRooms), true)) {
            $allowedOrigins = array_map(intval(...), (array) $this->config->get('pharmacy.executive_allowed_origins', []));
            abort_if(! in_array($visit->ward_id, $allowedOrigins, true), 422, 'Unit asal tidak berhak memakai farmasi eksekutif.');
        }

        // Ward penyimpanan obat: ikut ward kunjungan (rawat inap) atau ward pertama
        // untuk rawat jalan tanpa ward - disimpulkan sekali sebelum transaksi.
        $wardId = $visit->ward_id
            ?? Ward::query()->value('id');

        // 5-7) Efek dalam SATU transaksi; event menyusul setelah commit.
        $items = $prescription->items()->with('item')->get();

        $dispense = DB::transaction(function () use ($prescription, $user, $wardId, $items) {
            $totalQuantity = 0;

            foreach ($items as $item) {
                $quantity = max(1, (int) $item->quantity);
                $totalQuantity += $quantity;

                // 5) Gerbang stok + pengurangan (gerbang negatif hidup di
                //    WardStockService sesuai pharmacy.allow_order_out_of_stock).
                if ($wardId !== null) {
                    $this->stock->adjust(
                        (int) $wardId,
                        (int) $item->item_id,
                        'out',
                        $quantity,
                        $user,
                        "Dispense resep {$prescription->prescription_number}",
                    );
                }

                // 6) Posting tagihan via kontrak mesin billing (#9).
                $unitPrice = (float) ($item->item?->sell_price ?? 0);
                $this->billing->postServiceItem(
                    (int) $prescription->visit_id,
                    "Obat: {$item->drug_name}",
                    'medicine',
                    $quantity,
                    $unitPrice,
                    // Depo/ward yang benar-benar menyerahkan obat, bukan ward
                    // kunjungan — pendapatan farmasi harus jatuh ke unit farmasi.
                    $wardId,
                );
            }

            // 7) Catat dispense + finalisasi status (finalPelayananFarmasi).
            $record = PharmacyDispense::create([
                'prescription_id' => $prescription->id,
                'dispensed_by' => $user->id,
                'dispensed_at' => now(),
                'quantity' => $totalQuantity,
                'status' => 'dispensed',
            ]);

            $prescription->update(['status' => 'dispensed']);

            // Penyerahan obat melahirkan kunjungan di unit farmasi (padanan
            // `kunjungan.REF` prefix 14 legacy, dan alur `storeOrderResepDiFarmasi`
            // yang menautkan order resep ke kunjungan farmasinya). Tanpa ini
            // pendapatan farmasi tidak dapat dipisahkan dari poli pengirim.
            $this->derivedVisits->create($record, '11', (int) $prescription->visit_id, $user);

            return $record;
        });

        // Event di luar transaksi: listener hanya menyentuh data yang sudah commit.
        PrescriptionDispensed::dispatch($dispense->refresh());

        return $dispense;
    }

    /**
     * Batalkan satu record dispense (port pembatalan pelayanan farmasi).
     *
     * Gerbang: dispense yang sudah 'cancelled' tidak bisa dibatalkan lagi.
     * Efek (SATU transaksi): bila dispense sebelumnya berstatus 'dispensed',
     * stok yang tadi dikurangi dikembalikan (StockGate 'in' per item resep)
     * dan status Prescription disinkronkan balik ke 'active' agar bisa
     * dilayani ulang. Reversal tagihan tidak dilakukan di sini karena
     * BillingGate belum menyediakan kontrak pembatalan posting.
     */
    public function cancel(PharmacyDispense $dispense, User $user): PharmacyDispense
    {
        abort_if($dispense->status === 'cancelled', 422, 'Dispense sudah dibatalkan.');

        $prescription = $dispense->prescription()->firstOrFail();
        $wasDispensed = $dispense->status === 'dispensed';
        $items = $wasDispensed ? $prescription->items()->with('item')->get() : collect();
        $wardId = $wasDispensed
            ? ($prescription->visit?->ward_id ?? Ward::query()->value('id'))
            : null;

        return DB::transaction(function () use ($dispense, $prescription, $items, $wasDispensed, $wardId, $user) {
            if ($wasDispensed && $wardId !== null) {
                foreach ($items as $item) {
                    $quantity = max(1, (int) $item->quantity);
                    $this->stock->adjust(
                        (int) $wardId,
                        (int) $item->item_id,
                        'in',
                        $quantity,
                        $user,
                        "Pembatalan dispense resep {$prescription->prescription_number}",
                    );
                }

                $prescription->update(['status' => 'active']);
            }

            $dispense->update(['status' => 'cancelled']);

            return $dispense->refresh();
        });
    }

    /** Gerbang telaah: wajib ada review lulus; config 54 menambah syarat issues kosong. */
    protected function assertScreeningPassed(Prescription $prescription): void
    {
        $review = PrescriptionInitialReview::query()
            ->where('prescription_id', $prescription->id)
            ->latest('id')
            ->first();

        abort_if($review === null, 422, 'Resep belum ditelaah apoteker.');

        abort_if(! $review->is_appropriate, 422, 'Hasil telaah resep: TIDAK sesuai - tidak bisa dilayani.');

        if ((bool) $this->config->get('pharmacy.screening_requires_all_checked', true)) {
            abort_if(filled($review->issues_found), 422, 'Telaah masih mencatat masalah yang belum diselesaikan.');
        }
    }
}
