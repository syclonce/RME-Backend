<?php

namespace Modules\LayananRadiologyOrder\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;
use Modules\PendaftaranVisit\Support\DerivedVisitFactory;

/**
 * State machine order radiologi — meniru persis pola LabOrderService
 * (Modules/LayananLabOrder/app/Services/LabOrderService.php) supaya kedua
 * layanan penunjang diagnostik (lab & radiologi) berperilaku konsisten.
 *
 * Sebelumnya RadiologyOrderController menulis kolom status langsung lewat
 * update() tanpa gerbang apapun — status bisa lompat dari pending ke
 * completed, atau berubah setelah cancelled/completed. Service ini menutup
 * celah itu: transisi status HANYA lewat transition(), dengan pengecekan
 * dua kali (sebelum & sesudah lockForUpdate) untuk mencegah race antara dua
 * request konkuren yang membaca status lama yang sama.
 *
 * schedule()/cancel() diserap dari ImagingOrderService (keputusan pemilik
 * repo 2026-09-04) sebagai gerbang eksplisit di atas transition() — bukan
 * duplikasi state machine, hanya wrapper nyaman yang tetap memakai
 * TRANSITIONS + lock yang sama.
 */
class RadiologyOrderService
{
    // Lihat komentar RadiologyOrder::STATUSS untuk alasan pemetaan gabungan.
    private const TRANSITIONS = [
        'pending' => ['scheduled', 'in_progress', 'cancelled'],
        'scheduled' => ['in_progress', 'cancelled'],
        'in_progress' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => [],
    ];

    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
        protected DerivedVisitFactory $derivedVisits,
    ) {}

    /**
     * Order baru selalu lahir 'pending'. Kolom status tidak pernah diterima
     * dari input (lihat StoreRadiologyOrderRequest) — port semangat yang sama
     * dari ImagingOrderService::create().
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data, User $user): RadiologyOrder
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => RadiologyOrder::create([
            ...Arr::except($data, 'status'),
            'ordered_at' => $data['ordered_at'] ?? now(),
            'status' => 'pending',
        ]));
    }

    public function transition(RadiologyOrder $order, string $target, User $user): RadiologyOrder
    {
        $this->medicalRecordGate->assertWritable((int) $order->visit_id, $user);
        $allowed = self::TRANSITIONS[$order->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi radiologi {$order->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($order, $target, $user) {
            $locked = RadiologyOrder::query()->whereKey($order->id)->lockForUpdate()->firstOrFail();
            // Cek ulang setelah lock: status bisa saja sudah berubah oleh
            // transaksi lain di antara pengecekan pertama dan lock ini.
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status order radiologi sudah berubah.');
            $locked->update(['status' => $target]);

            // Order yang mulai DIKERJAKAN melahirkan kunjungan di unit radiologi
            // (padanan `kunjungan.REF` prefix 13). Dipicu pada 'in_progress',
            // bukan 'scheduled': dijadwalkan belum berarti unit menerimanya.
            if ($target === 'in_progress') {
                $this->derivedVisits->create($locked, '5', (int) $locked->visit_id, $user);
            }

            return $locked->refresh();
        });
    }

    /**
     * Gerbang penjadwalan eksplisit (diserap dari ImagingOrderController::schedule()).
     * Diizinkan dari 'pending' maupun 'scheduled' (penjadwalan ulang adalah
     * operasi normal — sama seperti ImagingOrderService::schedule()), ditolak
     * dari in_progress/completed/cancelled karena order sudah bergerak lebih
     * jauh atau sudah keluar dari antrean.
     */
    public function schedule(RadiologyOrder $order, string $scheduledAt, User $user): RadiologyOrder
    {
        $this->medicalRecordGate->assertWritable((int) $order->visit_id, $user);
        abort_unless(
            in_array($order->status, ['pending', 'scheduled'], true),
            422,
            "Order radiologi #{$order->id} berstatus {$order->status}; tidak dapat dijadwalkan.",
        );

        return DB::transaction(function () use ($order, $scheduledAt) {
            $locked = RadiologyOrder::query()->whereKey($order->id)->lockForUpdate()->firstOrFail();
            abort_unless(
                in_array($locked->status, ['pending', 'scheduled'], true),
                422,
                'Status order radiologi sudah berubah.',
            );
            $locked->update(['status' => 'scheduled', 'scheduled_at' => $scheduledAt]);

            return $locked->refresh();
        });
    }

    /**
     * Gerbang pembatalan eksplisit (diserap dari ImagingOrderController::cancel()).
     * Soft-cancel: baris tetap ada untuk jejak audit, hanya statusnya berubah.
     * Delegasi ke transition() supaya tetap satu jalur pengecekan TRANSITIONS.
     */
    public function cancel(RadiologyOrder $order, User $user): RadiologyOrder
    {
        return $this->transition($order, 'cancelled', $user);
    }
}
