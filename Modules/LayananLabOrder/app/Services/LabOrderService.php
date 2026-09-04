<?php

namespace Modules\LayananLabOrder\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\PendaftaranVisit\Support\DerivedVisitFactory;

class LabOrderService
{
    private const TRANSITIONS = [
        'pending' => ['in_progress', 'cancelled'],
        'in_progress' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => [],
    ];

    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
        protected DerivedVisitFactory $derivedVisits,
    ) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): LabOrder
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => LabOrder::create([
            ...Arr::except($data, 'status'),
            'order_number' => $data['order_number'] ?? LabOrder::generateOrderNumber(),
            'ordered_at' => $data['ordered_at'] ?? now(),
            'status' => 'pending',
        ]));
    }

    public function transition(LabOrder $order, string $target, User $user): LabOrder
    {
        $this->medicalRecordGate->assertWritable((int) $order->visit_id, $user);
        $allowed = self::TRANSITIONS[$order->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi lab {$order->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($order, $target, $user) {
            $locked = LabOrder::query()->whereKey($order->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status order lab sudah berubah.');
            $locked->update(['status' => $target]);

            // Pola legacy: order yang DITERIMA unit penunjang melahirkan kunjungan
            // di unit itu, menunjuk balik ke ordernya (`kunjungan.REF` prefix 12 =
            // order lab). Tanpa ini pelayanan laboratorium menumpang kunjungan poli
            // pengirim, sehingga tindakan dan tagihannya tidak dapat dipisahkan
            // per unit.
            //
            // Dipicu saat 'in_progress' — padanan penerimaan order di legacy,
            // bukan saat order dibuat (unit belum tentu menerimanya).
            if ($target === 'in_progress') {
                $this->derivedVisits->create($locked, '4', (int) $locked->visit_id, $user);
            }

            return $locked->refresh();
        });
    }
}
