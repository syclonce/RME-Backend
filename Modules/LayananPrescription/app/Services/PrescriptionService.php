<?php

namespace Modules\LayananPrescription\Services;

use App\Modules\Contracts\BillingGate;
use App\Modules\Contracts\HospitalConfig;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananPrescription\Models\Prescription;

/**
 * State machine resep (pola sama dengan LabOrderService::TRANSITIONS +
 * lockForUpdate + cek status dua kali).
 *
 * PENTING: 'dispensed' SENGAJA tidak ada di TRANSITIONS manapun sebagai
 * target dari service ini. Status itu hanya boleh diset oleh
 * Modules\LayananPharmacyDispense\Services\DispenseService::dispense() -
 * di sanalah stok dipotong dan tagihan diposting. Kalau service ini
 * menyediakan jalur active->dispensed, pemotongan stok/posting tagihan bisa
 * dilewati (resep "dispensed" tanpa efek farmasi). Karena itu satu-satunya
 * transisi yang dijaga di sini adalah pembatalan: active->cancelled.
 * Resep yang sudah dispensed tidak muncul di TRANSITIONS sama sekali,
 * sehingga transition() menolaknya (obat sudah keluar, stok sudah
 * terpotong - pembatalan resep bukan jalurnya, itu tugas retur farmasi).
 */
class PrescriptionService
{
    private const TRANSITIONS = [
        'active' => ['cancelled'],
        'dispensed' => [],
        'cancelled' => [],
    ];

    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
        protected BillingGate $billingGate,
        protected HospitalConfig $config,
    ) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): Prescription
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        // Port gerbang "tagihan terkunci kasir" simgos2 (ReturFarmasiResource.php:33,
        // TindakanMedisResource.php:41-43), digerbangi flag yang sama dengan
        // VisitService::admit() - padanan PropertiConfig 69. Dipindahkan dari
        // controller ke service supaya store() dan jalur lain yang lewat service
        // ini konsisten menghormatinya.
        abort_if(
            $this->config->get('billing.lock_on_cashier_close', true)
                && $this->billingGate->isVisitLocked((int) $data['visit_id']),
            422,
            'Tagihan kunjungan ini sudah dikunci kasir; resep baru tidak dapat dibuat.',
        );

        return DB::transaction(fn () => Prescription::create([
            ...$data,
            'prescription_number' => $data['prescription_number'] ?? Prescription::generatePrescriptionNumber(),
            'prescribed_at' => $data['prescribed_at'] ?? now(),
            'created_by' => $user->id,
            'status' => 'active',
        ]));
    }

    /**
     * Batalkan resep. Satu-satunya transisi keluar dari 'active' yang
     * disediakan service ini - lihat TRANSITIONS di atas untuk alasan
     * 'dispensed' tidak pernah muncul sebagai status asal yang diizinkan.
     */
    public function cancel(Prescription $prescription, User $user): Prescription
    {
        $this->medicalRecordGate->assertWritable((int) $prescription->visit_id, $user);

        $allowed = self::TRANSITIONS[$prescription->status] ?? [];
        abort_unless(
            in_array('cancelled', $allowed, true),
            422,
            "Resep berstatus {$prescription->status} tidak dapat dibatalkan.",
        );

        return DB::transaction(function () use ($prescription) {
            $locked = Prescription::query()->whereKey($prescription->id)->lockForUpdate()->firstOrFail();

            // Cek kedua setelah lock: mencegah race dengan DispenseService::dispense()
            // yang bisa saja mengubah status ke 'dispensed' di antara cek pertama dan lock.
            abort_unless(
                in_array('cancelled', self::TRANSITIONS[$locked->status] ?? [], true),
                422,
                'Status resep sudah berubah, tidak dapat dibatalkan.',
            );

            $locked->update(['status' => 'cancelled']);

            return $locked->refresh();
        });
    }
}
