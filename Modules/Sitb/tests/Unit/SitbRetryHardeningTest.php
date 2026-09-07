<?php

namespace Modules\Sitb\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Sitb\Models\PasienTb;
use Modules\Sitb\Services\SitbService;
use Tests\TestCase;

class SitbRetryHardeningTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['sitb.base_url' => 'https://sitb.local', 'sitb.id' => 'rs-1', 'sitb.key' => 'kunci']);
    }

    public function test_berhasil_menandai_terkirim(): void
    {
        Http::fake(['*/senddata' => Http::response(['status' => 'berhasil', 'id_tb_03' => 'TB-1'])]);
        $row = PasienTb::factory()->create(['kirim' => 1, 'attempts' => 0]);

        $result = app(SitbService::class)->kirimSemuaAntrian();

        $this->assertSame(0, $row->fresh()->kirim);
        $this->assertSame('TB-1', $row->fresh()->id_tb_03);
        $this->assertSame(['processed' => 1, 'sent' => 1, 'dead' => 0], $result);
    }

    public function test_gagal_tetap_antre_dan_attempts_naik(): void
    {
        Http::fake(['*/senddata' => Http::response(['status' => 'gagal', 'keterangan' => 'data kurang'], 200)]);
        $row = PasienTb::factory()->create(['kirim' => 1, 'attempts' => 0]);

        app(SitbService::class)->kirimSemuaAntrian();

        $fresh = $row->fresh();
        $this->assertSame(1, $fresh->kirim);
        $this->assertSame(1, $fresh->attempts);
        $this->assertNotNull($fresh->error_message);
    }

    public function test_melewati_batas_masuk_dead_letter(): void
    {
        $row = PasienTb::factory()->create([
            'kirim' => 1,
            'attempts' => SitbService::MAX_ATTEMPTS,
            'updated_at' => now()->subDays(2),
        ]);

        $result = app(SitbService::class)->kirimSemuaAntrian();

        $this->assertSame(2, $row->fresh()->kirim);
        $this->assertSame(['processed' => 0, 'sent' => 0, 'dead' => 1], $result);
        Http::assertNothingSent();
    }

    public function test_backoff_menahan_barusan_gagal_dan_limit_dihormati(): void
    {
        Http::fake(['*/senddata' => Http::response(['status' => 'berhasil'])]);
        $recent = PasienTb::factory()->create(['kirim' => 1, 'attempts' => 1, 'updated_at' => now()]);
        PasienTb::factory()->count(3)->create(['kirim' => 1, 'attempts' => 0, 'updated_at' => now()->subDay()]);

        $result = app(SitbService::class)->kirimSemuaAntrian(2);

        // 1 barusan-gagal dilewati (backoff, tetap antre), 2 dari 3 dikirim (limit).
        $this->assertSame(1, $recent->fresh()->attempts);
        $this->assertSame(2, $result['sent']);
        $this->assertSame(2, PasienTb::where('kirim', 1)->count());
    }
}
