<?php

namespace Modules\Sitb\Console\Commands;

use Illuminate\Console\Command;
use Modules\Sitb\Services\SitbService;

class RetrySitbSubmissions extends Command
{
    protected $signature = 'sitb:retry-submissions {--limit=50 : jumlah antrean terbanyak per jalan}';

    protected $description = 'Send any pasien_tb rows still queued (kirim = 1) to SITB';

    public function handle(SitbService $service): int
    {
        $result = $service->kirimSemuaAntrian((int) $this->option('limit'));

        $this->info("SITB retry pass complete: {$result['processed']} processed, {$result['sent']} sent, {$result['dead']} dead-lettered.");

        return self::SUCCESS;
    }
}
