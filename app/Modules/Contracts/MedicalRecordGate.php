<?php

namespace App\Modules\Contracts;

use Modules\Auth\Models\User;

/** Gerbang tunggal lifecycle RME lintas modul klinis. */
interface MedicalRecordGate
{
    public function assertWritable(int $visitId, User $user): void;

    public function start(int $visitId, User $user): object;

    public function finalize(int $visitId, User $user): object;

    public function beginAmendment(int $visitId, User $user, string $reason): object;

    public function status(int $visitId): ?string;
}
