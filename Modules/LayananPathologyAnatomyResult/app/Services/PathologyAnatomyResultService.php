<?php

namespace Modules\LayananPathologyAnatomyResult\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult;

class PathologyAnatomyResultService
{
    private const TRANSITIONS = [
        'pending' => ['final'],
        'final' => [],
    ];

    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
    ) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): PathologyAnatomyResult
    {
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return DB::transaction(fn () => PathologyAnatomyResult::create([
            ...Arr::except($data, 'status'),
            'status' => 'pending',
        ]));
    }

    public function transition(PathologyAnatomyResult $result, string $target, User $user): PathologyAnatomyResult
    {
        $this->medicalRecordGate->assertWritable((int) $result->visit_id, $user);
        $allowed = self::TRANSITIONS[$result->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi hasil PA {$result->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($result, $target) {
            $locked = PathologyAnatomyResult::query()->whereKey($result->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status hasil PA sudah berubah.');
            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
