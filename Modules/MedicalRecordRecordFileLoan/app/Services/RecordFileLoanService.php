<?php

namespace Modules\MedicalRecordRecordFileLoan\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\MedicalRecordRecordFileLoan\Models\RecordFileLoan;

/**
 * State machine peminjaman berkas RM: borrowed -> returned/overdue,
 * overdue -> returned. Sekali returned, final (berkas sudah kembali).
 */
class RecordFileLoanService
{
    private const TRANSITIONS = [
        'borrowed' => ['returned', 'overdue'],
        'overdue' => ['returned'],
        'returned' => [],
    ];

    /** @param array<string, mixed> $data */
    public function create(array $data): RecordFileLoan
    {
        return DB::transaction(fn () => RecordFileLoan::create([
            ...Arr::except($data, ['status', 'returned_at']),
            'status' => 'borrowed',
        ]));
    }

    public function transition(RecordFileLoan $loan, string $target): RecordFileLoan
    {
        $allowed = self::TRANSITIONS[$loan->status] ?? [];
        abort_unless(in_array($target, $allowed, true), 422, "Transisi peminjaman berkas {$loan->status} → {$target} tidak diizinkan.");

        return DB::transaction(function () use ($loan, $target) {
            $locked = RecordFileLoan::query()->whereKey($loan->id)->lockForUpdate()->firstOrFail();
            abort_unless(in_array($target, self::TRANSITIONS[$locked->status] ?? [], true), 422, 'Status peminjaman berkas sudah berubah.');

            $locked->update([
                'status' => $target,
                'returned_at' => $target === 'returned' ? now() : $locked->returned_at,
            ]);

            return $locked->refresh();
        });
    }
}
