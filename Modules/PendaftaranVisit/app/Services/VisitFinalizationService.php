<?php

namespace Modules\PendaftaranVisit\Services;

use App\Modules\Contracts\BillingGate;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\PendaftaranVisit\Models\Visit;

class VisitFinalizationService
{
    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
        protected BillingGate $billingGate,
    ) {}

    public function finalize(Visit $visit, User $user): Visit
    {
        abort_unless(
            $this->medicalRecordGate->status($visit->id) === MedicalRecordEpisode::STATUS_FINALIZED,
            422,
            'Finalkan RME sebelum finalisasi pelayanan.',
        );
        abort_if($this->billingGate->isVisitLocked($visit->id), 422, 'Tagihan sudah dikunci; pelayanan tidak dapat diubah.');

        return DB::transaction(function () use ($visit, $user) {
            $locked = Visit::query()->whereKey($visit->id)->lockForUpdate()->firstOrFail();
            abort_if($locked->status === 'cancelled', 422, 'Kunjungan batal tidak dapat difinalkan.');
            abort_if($locked->service_finalized_at !== null, 422, 'Pelayanan kunjungan sudah final.');

            $locked->update([
                'service_finalized_at' => now(),
                'service_finalized_by' => $user->id,
            ]);

            return $locked->refresh();
        });
    }
}
