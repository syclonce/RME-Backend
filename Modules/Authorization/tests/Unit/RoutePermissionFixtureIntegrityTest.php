<?php

namespace Modules\Authorization\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Authorization\Models\RoutePermission;
use Modules\Authorization\Support\RoutePermissionFixture;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Gerbang struktural RBAC dinamis (fondasi): bukan sweep HTTP 2.945 kali
 * (mahal) -- assert fixture statis + tabel route_permissions konsisten
 * dengan rute LIVE saat ini, dan grant baseline admin/petugas benar.
 *
 * Kalau ini gagal setelah menambah modul/rute baru, artinya
 * `php artisan rbac:sync-permissions` belum dijalankan ulang.
 */
class RoutePermissionFixtureIntegrityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Rute yang dikelola fixture: controller produk (Modules\*) + 3 rute
     * framework yang memang publik (sanctum csrf, up, storage). Rute dev-tool
     * (Telescope, hanya terdaftar bila Telescope aktif — ada di local, tidak
     * di testing) SENGAJA di luar perbandingan: memaksakannya membuat test
     * gagal silang-env tanpa hubungan dengan keamanan produk.
     */
    private static function isManaged(string $controllerAction): bool
    {
        if (str_starts_with($controllerAction, 'Modules\\')) {
            return true;
        }

        return in_array($controllerAction, [
            'GET sanctum/csrf-cookie',
            'GET up',
            'GET storage/{path}',
            'PUT storage/{path}',
        ], true);
    }

    public function test_setiap_rute_live_ada_di_fixture(): void
    {
        $map = RoutePermissionFixture::map();

        $missing = [];
        foreach (app('router')->getRoutes() as $route) {
            $key = RoutePermission::deriveControllerAction($route);
            if (! self::isManaged($key)) {
                continue;
            }
            if (! array_key_exists($key, $map)) {
                $missing[] = $key;
            }
        }

        $this->assertSame([], $missing, 'Rute berikut belum ada di fixture -- jalankan php artisan rbac:sync-permissions: '.implode(', ', $missing));
    }

    public function test_fixture_tidak_punya_baris_basi_untuk_rute_yang_sudah_hilang(): void
    {
        $liveKeys = collect(app('router')->getRoutes())
            ->map(fn ($route) => RoutePermission::deriveControllerAction($route))
            ->all();

        $stale = collect(RoutePermissionFixture::load())
            ->pluck('controller_action')
            ->filter(fn ($key) => self::isManaged($key))
            ->reject(fn ($key) => in_array($key, $liveKeys, true))
            ->all();

        $this->assertSame([], $stale, 'Fixture punya baris basi untuk rute yang sudah tidak ada -- jalankan ulang php artisan rbac:sync-permissions: '.implode(', ', $stale));
    }

    public function test_rute_non_publik_punya_permission_valid(): void
    {
        $withoutPermission = collect(RoutePermissionFixture::load())
            ->where('is_public', false)
            ->where('permission', null)
            ->pluck('controller_action')
            ->all();

        $this->assertSame([], $withoutPermission, 'Rute non-publik berikut tidak punya permission: '.implode(', ', $withoutPermission));
    }

    public function test_admin_mendapat_semua_permission_non_publik(): void
    {
        $this->seed(\Database\Seeders\RoleAndPermissionSeeder::class);

        $nonPublicPermissionCount = collect(RoutePermissionFixture::load())
            ->where('is_public', false)
            ->pluck('permission')
            ->filter()
            ->unique()
            ->count();

        $admin = Role::findByName('admin', config('auth.defaults.guard'));

        $this->assertSame($nonPublicPermissionCount, $admin->permissions()->count());
    }

    public function test_petugas_mendapat_tier_petugas_admin_dan_authenticated_any(): void
    {
        $this->seed(\Database\Seeders\RoleAndPermissionSeeder::class);

        $expectedCount = collect(RoutePermissionFixture::load())
            ->whereIn('legacy_tier', [RoutePermission::TIER_PETUGAS_ADMIN, RoutePermission::TIER_AUTHENTICATED_ANY])
            ->pluck('permission')
            ->filter()
            ->unique()
            ->count();

        $petugas = Role::findByName('petugas', config('auth.defaults.guard'));

        $this->assertSame($expectedCount, $petugas->permissions()->count());
    }
}
