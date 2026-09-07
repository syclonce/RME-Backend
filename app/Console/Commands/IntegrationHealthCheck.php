<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Modules\Bpjs\Services\BpjsSignature;

/**
 * Health-check kredensial integrasi (BPJS / E-Klaim / SATUSEHAT).
 *
 * Logika dan bentuk kredensial disamakan dengan yang jalan di produksi legacy
 * SIMGOS2 (peta induk Temuan 11-12): BPJS = cons_id/secret_key/user_key + header
 * X-cons-id/X-timestamp/X-signature HMAC-SHA256 yang SAMA PERSIS dengan
 * BaseService::setHeaderSignature; E-Klaim = satu kunci 256-bit hex;
 * SATUSEHAT = OAuth2 client_credentials tunggal.
 *
 * Tanpa --ping: murni cek konfigurasi + pembuatan signature (deterministik,
 * tanpa jaringan — aman untuk CI). Dengan --ping: uji jangkau host dengan
 * timeout 5 detik ala legacy (sendToIhs), catat latensi. Kegagalan koneksi
 * TIDAK pernah menyembunyikan status: unreachable tercatat eksplisit, bukan
 * ditelan seperti catch legacy.
 */
class IntegrationHealthCheck extends Command
{
    protected $signature = 'integrations:health {--ping : uji jangkau host (timeout 5 dtk)} {--json : keluaran JSON untuk monitoring}';

    protected $description = 'Cek kredensial + jangkau integrasi BPJS/E-Klaim/SATUSEHAT ala perilaku produksi legacy';

    public function handle(BpjsSignature $signature): int
    {
        $rows = [
            ...$this->checkBpjs($signature),
            $this->checkEklaim(),
            $this->checkSatusehat(),
        ];

        if ($this->option('json')) {
            // Satu objek JSON per baris (JSONL): bisa di-stream/grep oleh
            // monitoring, dan tiap baris tercatat sebagai satu write.
            foreach ($rows as $row) {
                $this->line(json_encode($row, JSON_UNESCAPED_SLASHES));
            }

            return $this->exitCode($rows);
        }

        $this->table(
            ['layanan', 'terkonfigurasi', 'cek_lokal', 'terjangkau', 'latensi_ms', 'pesan'],
            array_map(fn (array $r) => [
                $r['service'],
                $r['configured'] ? 'YA' : 'TIDAK',
                $r['check'] ?? '-',
                $r['reachable'] ?? 'lewati',
                $r['latency_ms'] ?? '-',
                $r['message'],
            ], $rows)
        );

        return $this->exitCode($rows);
    }

    /** @return list<array<string, mixed>> */
    private function checkBpjs(BpjsSignature $signature): array
    {
        $rows = [];
        $timezone = (string) config('bpjs.timezone', 'Asia/Jakarta');
        $addTime = (string) config('bpjs.signature_add_time', 'PT0S');

        foreach ((array) config('bpjs.families', []) as $family => $cfg) {
            $cfg = is_array($cfg) ? $cfg : [];
            $missing = array_values(array_filter(
                ['base_url', 'cons_id', 'secret_key', 'user_key'],
                fn (string $k) => blank($cfg[$k] ?? null)
            ));

            if ($missing !== []) {
                $rows[] = $this->row("bpjs.{$family}", false, null, null, null, 'kredensial kosong: '.implode(', ', $missing));
                continue;
            }

            // Cek lokal = pembuatan signature persis jalur produksi (tanpa jaringan).
            try {
                $headers = $signature->headers($cfg, $timezone, $addTime);
                $sigOk = filled($headers['X-signature'] ?? null) && filled($headers['X-timestamp'] ?? null);
            } catch (\Throwable $e) {
                $rows[] = $this->row("bpjs.{$family}", true, 'TIDAK', null, null, 'signature gagal: '.$e->getMessage());
                continue;
            }

            if (! $sigOk) {
                $rows[] = $this->row("bpjs.{$family}", true, 'TIDAK', null, null, 'header signature tak lengkap');
                continue;
            }

            $rows[] = $this->row(
                "bpjs.{$family}", true, 'YA',
                ...$this->ping($this->option('ping'), (string) $cfg['base_url'], 'signature OK')
            );
        }

        return $rows;
    }

    /** @return array<string, mixed> */
    private function checkEklaim(): array
    {
        $baseUrl = (string) (config('eklaim.base_url') ?? '');
        $key = (string) (config('eklaim.key') ?? '');

        if ($baseUrl === '' || $key === '') {
            return $this->row('eklaim', false, null, null, null, 'EKLAIM_BASE_URL / EKLAIM_KEY kosong');
        }

        // Kunci E-Klaim = 64 hex (256-bit), dibuat manual di admin UI E-Klaim —
        // bukan pasangan cons_id/secret. Beda skema dari BPJS/SATUSEHAT.
        if (! preg_match('/^[0-9a-fA-F]{64}$/', $key)) {
            return $this->row('eklaim', true, 'TIDAK', null, null, 'EKLAIM_KEY harus 64 karakter hex');
        }

        return $this->row('eklaim', true, 'YA', ...$this->ping($this->option('ping'), $baseUrl, 'format kunci OK'));
    }

    /** @return array<string, mixed> */
    private function checkSatusehat(): array
    {
        $keys = ['auth_url', 'base_url', 'client_id', 'client_secret', 'organization_id'];
        $missing = array_values(array_filter($keys, fn (string $k) => blank(config("satusehat.{$k}"))));

        if ($missing !== []) {
            return $this->row('satusehat', false, null, null, null, 'kredensial kosong: '.implode(', ', $missing));
        }

        foreach (['auth_url', 'base_url'] as $u) {
            if (! is_string(config("satusehat.{$u}")) || filter_var(config("satusehat.{$u}"), FILTER_VALIDATE_URL) === false) {
                return $this->row('satusehat', true, 'TIDAK', null, null, "satusehat.{$u} bukan URL valid");
            }
        }

        return $this->row(
            'satusehat', true, 'YA',
            ...$this->ping($this->option('ping'), (string) config('satusehat.auth_url'), 'konfigurasi OK')
        );
    }

    /**
     * @return array{0: string|null, 1: int|null, 2: string} [reachable, latency_ms, message]
     */
    private function ping(bool $doPing, string $url, string $okMessage): array
    {
        if (! $doPing) {
            return [null, null, $okMessage.' (tanpa uji jangkau)'];
        }

        $start = microtime(true);

        try {
            Http::timeout(5)->get($url);
            $latency = (int) round((microtime(true) - $start) * 1000);

            // Host menjawab (status apa pun) = terjangkau. 4xx/5xx dari gateway
            // adalah jawaban credentials/path, bukan bukti host mati — yang
            // dicatat unreachable hanya kegagalan koneksi.
            return ['YA', $latency, $okMessage."; host menjawab {$latency} ms"];
        } catch (\Throwable $e) {
            $latency = (int) round((microtime(true) - $start) * 1000);

            return ['TIDAK', $latency, 'host tak terjangkau: '.$e->getMessage()];
        }
    }

    /** @return array<string, mixed> */
    private function row(string $service, bool $configured, ?string $check, ?string $reachable, ?int $latencyMs, string $message): array
    {
        return [
            'service' => $service,
            'configured' => $configured,
            'check' => $check,
            'reachable' => $reachable,
            'latency_ms' => $latencyMs,
            'message' => $message,
        ];
    }

    /** @param list<array<string, mixed>> $rows */
    private function exitCode(array $rows): int
    {
        foreach ($rows as $r) {
            if (! $r['configured'] || $r['check'] === 'TIDAK' || $r['reachable'] === 'TIDAK') {
                return self::FAILURE;
            }
        }

        return self::SUCCESS;
    }
}
