<?php

namespace Modules\MedicalRecordInterventionProtocol\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\GeneralEmployee\Models\Employee;
use Modules\Auth\Models\User;
use Modules\MedicalRecordInterventionProtocol\Models\InterventionProtocol;

/**
 * State machine protokol intervensi — pola LabOrderService/SurgeryService:
 * TRANSITIONS map, lockForUpdate + cek status ganda, gerbang RME lewat MedicalRecordGate.
 *
 * Nilai status ('active','completed','discontinued') berasal dari
 * StoreInterventionProtocolRequest (rules 'status' => in:active,completed,discontinued).
 * completed = protokol selesai sesuai rencana, discontinued = dihentikan sebelum
 * selesai (mis. tidak toleran/kontraindikasi baru) — keduanya final.
 */
class InterventionProtocolService
{
    private const TRANSITIONS = [
        'active' => ['completed', 'discontinued'],
        'completed' => [],
        'discontinued' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): InterventionProtocol
    {
        // Kolom pelaku menunjuk employees, BUKAN users. Diisi dari profil
        // pegawai user login supaya petugas tidak perlu menghafal id
        // pegawainya sendiri (lihat App\Http\Concerns\ResolvesActingEmployee).
        $data['started_by'] ??= Employee::query()->where('user_id', $user->id)->value('id');
        abort_if(
            $data['started_by'] === null,
            422,
            'Akun Anda belum tertaut ke data pegawai, sehingga pencatat tidak dapat ditetapkan. Hubungi admin untuk menautkannya.',
        );

        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => InterventionProtocol::create([
            ...Arr::except($data, 'status'),
            'started_at' => $data['started_at'] ?? now(),
            'status' => 'active',
            'created_by' => $user->id,
        ]));
    }

    public function transition(InterventionProtocol $record, string $target, User $user): InterventionProtocol
    {
        $this->medicalRecordGate->assertWritable((int) $record->visit_id, $user);
        $allowed = self::TRANSITIONS[$record->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi protokol intervensi {$record->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($record, $target) {
            $locked = InterventionProtocol::query()->whereKey($record->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status protokol intervensi sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
