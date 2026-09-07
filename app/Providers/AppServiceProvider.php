<?php

namespace App\Providers;

use App\Modules\Contracts\BedGate;
use App\Modules\Contracts\BillingGate;
use App\Modules\Contracts\HospitalConfig;
use App\Modules\Contracts\EncounterFinalizationRule;
use App\Modules\Contracts\MedicalRecordGate;
use App\Modules\Contracts\ServiceEpisodeGate;
use App\Modules\Contracts\CashierShiftGate;
use App\Modules\Contracts\StockGate;
use App\Modules\Contracts\VisitGate;
use App\Modules\Contracts\WardScope;
use App\Support\RsSettingService;
use App\Support\WardAccessResolver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Kontrak antar-modul (#7 service layer): modul klinis bergantung pada
     * interface di app/Modules/Contracts, bukan model/service modul lain.
     */
    protected array $contracts = [
        HospitalConfig::class => RsSettingService::class,
        BillingGate::class => \Modules\PembayaranInvoice\Services\InvoiceService::class,
        VisitGate::class => \Modules\PendaftaranVisit\Services\VisitService::class,
        StockGate::class => \Modules\InventoryWardStockTransaction\Services\WardStockService::class,
        BedGate::class => \Modules\GeneralBed\Services\BedService::class,
        WardScope::class => WardAccessResolver::class,
        ServiceEpisodeGate::class => \Modules\PendaftaranVisit\Services\VisitServiceState::class,
        CashierShiftGate::class => \Modules\PembayaranCashierShift\Services\CashierShiftService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->contracts as $contract => $implementation) {
            $this->app->bind($contract, $implementation);
        }

        $this->app->tag([
            \Modules\MedicalRecordClinicalNote\Rules\ClinicalNoteFinalizationRule::class,
            \Modules\MedicalRecordDiagnosis\Rules\DiagnosisFinalizationRule::class,
            \Modules\LayananLabOrder\Rules\LabOrderFinalizationRule::class,
            // LayananImagingOrder dihapus 2026-09-04 — fiturnya digabung ke
            // LayananRadiologyOrder (keputusan pemilik repo); gerbang finalisasi
            // yang sama sekarang ditegakkan oleh RadiologyOrderFinalizationRule.
            \Modules\LayananRadiologyOrder\Rules\RadiologyOrderFinalizationRule::class,
            \Modules\LayananPrescription\Rules\PrescriptionFinalizationRule::class,
        ], EncounterFinalizationRule::class);

        $this->app->singleton(MedicalRecordGate::class, fn ($app) =>
            new \Modules\MedicalRecordEpisode\Services\MedicalRecordEpisodeService(
                $app->tagged(EncounterFinalizationRule::class),
                $app->make(VisitGate::class),
            )
        );
        $this->app->singleton(RsSettingService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->assertDatabasePasswordConfigured();

        // Rollout guard rekam medis (Fase 3 legacy): satu titik penegakan untuk
        // ±162 modul MR — update/delete pada episode final ditolak dari jalur
        // mana pun. Controller guard (GuardsMedicalRecord) tetap ada sebagai
        // lapis atribusi user; observer ini jaring pengaman terakhir.
        \App\Observers\MedicalRecordMutationGuard::register();
    }

    /**
     * Fail fast di luar local/testing kalau koneksi DB non-sqlite dikonfigurasi
     * tanpa password -- lebih baik proses tidak jalan sama sekali daripada
     * server produksi diam-diam menerima koneksi database tanpa kredensial.
     */
    protected function assertDatabasePasswordConfigured(): void
    {
        if ($this->app->environment(['local', 'testing'])) {
            return;
        }

        $connectionName = config('database.default');

        if ($connectionName === 'sqlite') {
            return;
        }

        $password = config("database.connections.{$connectionName}.password");

        if (blank($password)) {
            throw new \RuntimeException(
                "DB_PASSWORD kosong untuk koneksi database '{$connectionName}' di luar environment local/testing. ".
                'Set kredensial database sebelum menjalankan aplikasi di lingkungan ini.'
            );
        }
    }
}
