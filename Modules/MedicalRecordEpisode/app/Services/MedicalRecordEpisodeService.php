<?php

namespace Modules\MedicalRecordEpisode\Services;

use App\Modules\Contracts\EncounterFinalizationRule;
use App\Modules\Contracts\MedicalRecordGate;
use App\Modules\Contracts\VisitGate;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisodeTransition;

class MedicalRecordEpisodeService implements MedicalRecordGate
{
    /** @param iterable<EncounterFinalizationRule> $rules */
    public function __construct(protected iterable $rules, protected VisitGate $visitGate) {}

    public function status(int $visitId): ?string
    {
        return MedicalRecordEpisode::query()->where('visit_id', $visitId)->value('status');
    }

    public function start(int $visitId, User $user): MedicalRecordEpisode
    {
        abort_unless($this->visitGate->isActive($visitId), 422, 'RME hanya dapat dibuka untuk kunjungan aktif.');

        return DB::transaction(function () use ($visitId, $user) {
            $episode = MedicalRecordEpisode::query()->firstOrCreate(
                ['visit_id' => $visitId],
                ['status' => MedicalRecordEpisode::STATUS_OPEN, 'version' => 1],
            );

            if ($episode->wasRecentlyCreated) {
                $this->recordTransition($episode, null, MedicalRecordEpisode::STATUS_OPEN, $user, 'RME dibuka');
            }

            return $episode;
        });
    }

    public function assertWritable(int $visitId, User $user): void
    {
        $episode = MedicalRecordEpisode::query()->where('visit_id', $visitId)->first();

        if ($episode === null) {
            $this->start($visitId, $user);
            return;
        }

        abort_if(
            $episode->status === MedicalRecordEpisode::STATUS_FINALIZED,
            422,
            'RME sudah final. Gunakan jalur amendment sebelum menambah catatan koreksi.',
        );

        abort_unless(
            $episode->status === MedicalRecordEpisode::STATUS_AMENDING || $this->visitGate->isActive($visitId),
            422,
            'Kunjungan tidak aktif; RME tidak dapat diubah.',
        );
    }

    public function finalize(int $visitId, User $user): MedicalRecordEpisode
    {
        abort_unless($this->visitGate->canFinalizeMedicalRecord($visitId), 422, 'Kunjungan batal atau tidak ditemukan.');

        $violations = [];
        foreach ($this->rules as $rule) {
            array_push($violations, ...$rule->violations($visitId));
        }
        abort_if($violations !== [], 422, implode(' ', $violations));

        return DB::transaction(function () use ($visitId, $user) {
            $episode = MedicalRecordEpisode::query()->where('visit_id', $visitId)->lockForUpdate()->first();
            abort_if($episode === null, 422, 'RME belum dibuka.');
            abort_if($episode->status === MedicalRecordEpisode::STATUS_FINALIZED, 422, 'RME sudah final.');

            $from = $episode->status;
            $episode->update([
                'status' => MedicalRecordEpisode::STATUS_FINALIZED,
                'finalized_at' => now(),
                'finalized_by' => $user->id,
            ]);
            $this->recordTransition($episode, $from, MedicalRecordEpisode::STATUS_FINALIZED, $user, 'RME difinalkan');

            return $episode->refresh();
        });
    }

    public function beginAmendment(int $visitId, User $user, string $reason): MedicalRecordEpisode
    {
        abort_unless($this->visitGate->canFinalizeMedicalRecord($visitId), 422, 'Kunjungan batal atau tidak ditemukan.');
        abort_if(trim($reason) === '', 422, 'Alasan amendment wajib diisi.');

        return DB::transaction(function () use ($visitId, $user, $reason) {
            $episode = MedicalRecordEpisode::query()->where('visit_id', $visitId)->lockForUpdate()->firstOrFail();
            abort_unless($episode->status === MedicalRecordEpisode::STATUS_FINALIZED, 422, 'Amendment hanya dapat dimulai dari RME final.');

            $episode->update([
                'status' => MedicalRecordEpisode::STATUS_AMENDING,
                'version' => $episode->version + 1,
                'finalized_at' => null,
                'finalized_by' => null,
            ]);
            $this->recordTransition($episode, MedicalRecordEpisode::STATUS_FINALIZED, MedicalRecordEpisode::STATUS_AMENDING, $user, trim($reason));

            return $episode->refresh();
        });
    }

    protected function recordTransition(MedicalRecordEpisode $episode, ?string $from, string $to, User $user, string $reason): void
    {
        MedicalRecordEpisodeTransition::create([
            'episode_id' => $episode->id,
            'from_status' => $from,
            'to_status' => $to,
            'reason' => $reason,
            'performed_by' => $user->id,
            'performed_at' => now(),
        ]);
    }
}
