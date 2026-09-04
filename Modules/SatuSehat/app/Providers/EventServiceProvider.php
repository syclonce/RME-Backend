<?php

namespace Modules\SatuSehat\Providers;

use App\Events\VisitDischarged;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\GeneralPatient\Models\Patient;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\MedicalRecordVitalSign\Models\VitalSign;
use Modules\SatuSehat\Listeners\QueueEncounterOnDischarge;
use Modules\SatuSehat\Observers\QueueConditionOnDiagnosisCreated;
use Modules\SatuSehat\Observers\QueueObservationOnVitalSignCreated;
use Modules\SatuSehat\Observers\QueuePatientOnSave;
use Modules\SatuSehat\Observers\QueueProcedureOnMedicalProcedureSaved;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        VisitDischarged::class => [QueueEncounterOnDischarge::class],
    ];

    /**
     * @var bool
     */
    protected static $shouldDiscoverEvents = false;

    /**
     * Patient, Diagnosis, VitalSign dan MedicalProcedure tidak punya event
     * domain sendiri (`EventServiceProvider` modul masing-masing kosong,
     * controller memanggil `Model::create()`/`update()` langsung) — dipakai
     * model observer di sini, bukan event baru, sesuai arahan untuk tidak
     * menambah event kalau tidak perlu. Observer didaftarkan lewat container
     * (`app(...)`) karena masing-masing butuh `SatuSehatOutboxService`.
     */
    public function boot(): void
    {
        parent::boot();

        Patient::observe($this->app->make(QueuePatientOnSave::class));
        Diagnosis::observe($this->app->make(QueueConditionOnDiagnosisCreated::class));
        VitalSign::observe($this->app->make(QueueObservationOnVitalSignCreated::class));
        MedicalProcedure::observe($this->app->make(QueueProcedureOnMedicalProcedureSaved::class));
    }

    protected function configureEmailVerification(): void {}
}
