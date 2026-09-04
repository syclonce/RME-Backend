<?php

namespace App\Modules\Contracts;

/** Read-only contract status final pelayanan untuk consumer finansial/klaim. */
interface ServiceEpisodeGate
{
    public function isFinalized(int $visitId): bool;

    public function assertFinalized(int $visitId): void;
}
