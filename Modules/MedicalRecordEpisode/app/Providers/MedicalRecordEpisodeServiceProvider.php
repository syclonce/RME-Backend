<?php

namespace Modules\MedicalRecordEpisode\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class MedicalRecordEpisodeServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'MedicalRecordEpisode';

    protected string $nameLower = 'medicalrecordepisode';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
