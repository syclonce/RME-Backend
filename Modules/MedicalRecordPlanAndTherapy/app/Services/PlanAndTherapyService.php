<?php

namespace Modules\MedicalRecordPlanAndTherapy\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\GeneralEmployee\Models\Employee;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPlanAndTherapy\Models\PlanAndTherapy;

/**
 * State machine rencana & terapi — pola LabOrderService/SurgeryService:
 * TRANSITIONS map, lockForUpdate + cek status ganda, gerbang RME lewat MedicalRecordGate.
 *
 * Nilai status ('active','completed','revised') berasal dari
 * StorePlanAndTherapyRequest (rules 'status' => in:active,completed,revised).
 * 'revised' berarti rencana terapi diubah (mis. dosis/jenis terapi berganti) dan
 * masih bisa lanjut ke completed. 'completed' adalah akhir terapi dan final.
 */
class PlanAndTherapyService
{
    private const TRANSITIONS = [
        'active' => ['completed', 'revised'],
        'revised' => ['completed'],
        'completed' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): PlanAndTherapy
    {
        // `ordered_by` menunjuk employees, BUKAN users: dokter yang menulis
        // order adalah yang sedang login, tapi id pegawainya tidak diketahui
        // petugas dari layar mana pun (lihat App\Http\Concerns\ResolvesActingEmployee).
        $data['ordered_by'] ??= Employee::query()->where('user_id', $user->id)->value('id');
        abort_if(
            $data['ordered_by'] === null,
            422,
            'Akun Anda belum tertaut ke data pegawai, sehingga pemesan order tidak dapat ditetapkan. Hubungi admin untuk menautkannya.',
        );

        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => PlanAndTherapy::create([
            ...Arr::except($data, 'status'),
            'ordered_at' => $data['ordered_at'] ?? now(),
            'status' => 'active',
            'created_by' => $user->id,
        ]));
    }

    public function transition(PlanAndTherapy $record, string $target, User $user): PlanAndTherapy
    {
        $this->medicalRecordGate->assertWritable((int) $record->visit_id, $user);
        $allowed = self::TRANSITIONS[$record->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi rencana & terapi {$record->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($record, $target) {
            $locked = PlanAndTherapy::query()->whereKey($record->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status rencana & terapi sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
