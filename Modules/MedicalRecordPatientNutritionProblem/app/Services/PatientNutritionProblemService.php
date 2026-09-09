<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\GeneralEmployee\Models\Employee;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPatientNutritionProblem\Models\PatientNutritionProblem;

/**
 * State machine masalah gizi pasien — pola LabOrderService/SurgeryService:
 * TRANSITIONS map, lockForUpdate + cek status ganda, gerbang RME lewat MedicalRecordGate.
 *
 * Nilai status ('open','in_progress','resolved') berasal dari
 * StorePatientNutritionProblemRequest (rules 'status' => in:open,in_progress,resolved).
 * open = masalah baru teridentifikasi, in_progress = intervensi gizi sedang
 * berjalan, resolved = masalah teratasi (final).
 */
class PatientNutritionProblemService
{
    private const TRANSITIONS = [
        'open' => ['in_progress', 'resolved'],
        'in_progress' => ['resolved'],
        'resolved' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): PatientNutritionProblem
    {
        // Kolom pelaku menunjuk employees, BUKAN users. Diisi dari profil
        // pegawai user login supaya petugas tidak perlu menghafal id
        // pegawainya sendiri (lihat App\Http\Concerns\ResolvesActingEmployee).
        $data['identified_by'] ??= Employee::query()->where('user_id', $user->id)->value('id');
        abort_if(
            $data['identified_by'] === null,
            422,
            'Akun Anda belum tertaut ke data pegawai, sehingga pencatat tidak dapat ditetapkan. Hubungi admin untuk menautkannya.',
        );

        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => PatientNutritionProblem::create([
            ...Arr::except($data, 'status'),
            'identified_at' => $data['identified_at'] ?? now(),
            'status' => 'open',
            'created_by' => $user->id,
        ]));
    }

    public function transition(PatientNutritionProblem $record, string $target, User $user): PatientNutritionProblem
    {
        $this->medicalRecordGate->assertWritable((int) $record->visit_id, $user);
        $allowed = self::TRANSITIONS[$record->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi masalah gizi {$record->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($record, $target) {
            $locked = PatientNutritionProblem::query()->whereKey($record->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status masalah gizi sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
