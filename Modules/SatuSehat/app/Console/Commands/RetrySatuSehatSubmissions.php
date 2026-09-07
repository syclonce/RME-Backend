<?php

namespace Modules\SatuSehat\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Modules\SatuSehat\Services\SatuSehatClient;

class RetrySatuSehatSubmissions extends Command
{
    protected $signature = 'satusehat:retry-submissions {--limit=50 : jumlah antrean terbanyak per jalan}';

    protected $description = 'Retry any staged SATUSEHAT FHIR submissions still pending or failed';

    /**
     * Batas percobaan sebelum masuk dead-letter. Di atas ini worker berhenti
     * mencoba dan menyerahkan ke petugas (dashboard tindak-lanjut) — tanpa ini
     * satu baris rusak akan di-POST selamanya setiap menit.
     */
    public const MAX_ATTEMPTS = 10;

    public function handle(SatuSehatClient $client): int
    {
        $limit = max(1, (int) $this->option('limit'));
        $processed = 0;
        $sent = 0;
        $dead = 0;

        // Tertua dulu (adil) + batas per jalan (spike 10.000 baris tidak
        // menahan scheduler). lockForUpdate per baris supaya dua worker
        // yang jalan bersamaan tidak mengirim dobel ke SATUSEHAT.
        $ids = SatuSehatStagingSubmission::query()
            ->whereIn('status', ['pending', 'failed'])
            ->orderBy('id')
            ->limit($limit)
            ->pluck('id');

        foreach ($ids as $id) {
            $submission = DB::transaction(function () use ($id) {
                return SatuSehatStagingSubmission::query()
                    ->whereKey($id)
                    ->whereIn('status', ['pending', 'failed'])
                    ->lockForUpdate()
                    ->first();
            });

            if ($submission === null) {
                continue;
            }

            // Backoff eksponensial tanpa kolom tambahan: jeda = min(300*2^(n-1), 7200)
            // dari updated_at. Gagal pertama dicoba lagi setelah 5 menit, bukan
            // setiap menit — tanpa ini SATUSEHAT yang sedang down akan di-spam.
            // Baris pending yang belum pernah dicoba (attempts=0) selalu jalan.
            if ($submission->attempts > 0 && $submission->updated_at !== null) {
                $delay = min(300 * (2 ** ($submission->attempts - 1)), 7200);
                if ($submission->updated_at->gt(now()->subSeconds($delay))) {
                    continue;
                }
            }

            // Dead-letter: berhenti mencoba, TETAP di tabel dengan status 'dead'
            // + last_error — kebalikan cacat legacy yang menandai SELESAI saat
            // gagal dan menghapus jejaknya dari antrean.
            if ($submission->attempts >= self::MAX_ATTEMPTS) {
                $submission->update(['status' => 'dead']);
                $dead++;
                continue;
            }

            $client->send($submission->fresh());
            $processed++;

            if ($submission->fresh()->status === 'sent') {
                $sent++;
            }
        }

        $this->info("Retried {$processed} staged submission(s): {$sent} sent, {$dead} dead-lettered.");

        return self::SUCCESS;
    }
}
