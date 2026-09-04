<?php

namespace Modules\PendaftaranVisit\Services;

use App\Modules\Contracts\ServiceEpisodeGate;
use Modules\PendaftaranVisit\Models\Visit;

class VisitServiceState implements ServiceEpisodeGate
{
    public function isFinalized(int $visitId): bool
    {
        return Visit::query()->whereKey($visitId)->whereNotNull('service_finalized_at')->exists();
    }

    public function assertFinalized(int $visitId): void
    {
        abort_unless($this->isFinalized($visitId), 422, 'Pelayanan kunjungan belum difinalkan.');
    }
}
