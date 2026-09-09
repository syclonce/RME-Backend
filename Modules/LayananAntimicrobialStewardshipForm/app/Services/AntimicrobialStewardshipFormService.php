<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;

class AntimicrobialStewardshipFormService
{
    private const TRANSITIONS = [
        'draft' => ['submitted'],
        'submitted' => ['approved', 'rejected'],
        'approved' => [],
        'rejected' => [],
    ];

    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
    ) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): AntimicrobialStewardshipForm
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => AntimicrobialStewardshipForm::create([
            ...Arr::except($data, ['status', 'submitted_at']),
            'status' => 'draft',
        ]));
    }

    public function transition(AntimicrobialStewardshipForm $form, string $target, User $user): AntimicrobialStewardshipForm
    {
        $this->medicalRecordGate->assertWritable((int) $form->visit_id, $user);
        $allowed = self::TRANSITIONS[$form->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi formulir antimikroba {$form->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($form, $target) {
            $locked = AntimicrobialStewardshipForm::query()->whereKey($form->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status formulir antimikroba sudah berubah.');

            $update = ['status' => $target];
            if ($target === 'submitted') {
                $update['submitted_at'] = now();
            }
            $locked->update($update);

            return $locked->refresh();
        });
    }
}
