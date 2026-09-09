<?php

namespace Modules\Auth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Models\User;
use Tests\TestCase;

class MyAccountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_without_any_role_can_update_own_profile(): void
    {
        $user = User::factory()->create(['name' => 'Lama']);
        $this->actingAs($user, 'sanctum');

        $response = $this->putJson('/api/v1/me', [
            'name' => 'Baru',
            'username' => 'baru-username',
            'email' => 'baru@example.com',
        ]);

        $response->assertOk()->assertJsonPath('data.name', 'Baru');
        $this->assertSame('baru-username', $user->fresh()->username);
        $this->assertSame('baru@example.com', $user->fresh()->email);
    }

    public function test_update_profile_ignores_locked_active_and_password_fields(): void
    {
        $user = User::factory()->create(['is_locked' => false, 'is_active' => true]);
        $originalPassword = $user->password;
        $this->actingAs($user, 'sanctum');

        $this->putJson('/api/v1/me', [
            'is_locked' => true,
            'is_active' => false,
            'password' => 'AbaikanSaja123',
        ])->assertOk();

        $fresh = $user->fresh();
        $this->assertFalse($fresh->is_locked);
        $this->assertTrue($fresh->is_active);
        $this->assertSame($originalPassword, $fresh->password);
    }

    public function test_update_password_fails_with_wrong_current_password(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->putJson('/api/v1/me/password', [
            'current_password' => 'salah',
            'password' => 'PasswordBaru123',
            'password_confirmation' => 'PasswordBaru123',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('current_password');
    }

    public function test_update_password_succeeds_and_revokes_other_sessions_only(): void
    {
        $user = User::factory()->create(['username' => 'budi']);

        $loginA = $this->postJson('/api/v1/login', ['login' => 'budi', 'password' => 'password', 'device_name' => 'device-a']);
        $tokenA = $loginA->json('token');

        $loginB = $this->postJson('/api/v1/login', ['login' => 'budi', 'password' => 'password', 'device_name' => 'device-b']);
        $tokenB = $loginB->json('token');

        $response = $this->withHeader('Authorization', "Bearer {$tokenA}")->putJson('/api/v1/me/password', [
            'current_password' => 'password',
            'password' => 'PasswordBaru123',
            'password_confirmation' => 'PasswordBaru123',
        ]);

        $response->assertOk()->assertJsonPath('message', 'Password berhasil diubah.');

        $this->assertNotNull($user->fresh()->password_changed_at);

        // RequestGuard men-cache user hasil resolusi pertama per instance guard,
        // dan instance itu bertahan lintas panggilan withHeader() dalam satu
        // test -- reset supaya request berikut benar-benar resolve ulang dari DB.
        Auth::forgetGuards();

        // Token yang dipakai untuk ganti password tetap hidup.
        $this->withHeader('Authorization', "Bearer {$tokenA}")->getJson('/api/v1/me')->assertOk();

        Auth::forgetGuards();

        // Token device lain harus ter-revoke.
        $this->withHeader('Authorization', "Bearer {$tokenB}")->getJson('/api/v1/me')->assertStatus(401);
    }

    public function test_sessions_lists_only_own_tokens_and_hides_raw_token(): void
    {
        $user = User::factory()->create(['username' => 'budi']);
        $other = User::factory()->create();
        $other->createToken('other-device');

        $login = $this->postJson('/api/v1/login', ['login' => 'budi', 'password' => 'password', 'device_name' => 'my-device']);
        $token = $login->json('token');

        $response = $this->withHeader('Authorization', "Bearer {$token}")->getJson('/api/v1/me/sessions');

        $response->assertOk()->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.name', 'my-device');
        $response->assertJsonPath('data.0.is_current_device', true);
        $response->assertJsonMissingPath('data.0.token');
        $this->assertStringNotContainsString($token, $response->getContent());
    }

    public function test_revoke_all_sessions_logs_out_every_device(): void
    {
        $user = User::factory()->create(['username' => 'budi']);

        $loginA = $this->postJson('/api/v1/login', ['login' => 'budi', 'password' => 'password', 'device_name' => 'device-a']);
        $tokenA = $loginA->json('token');

        $response = $this->withHeader('Authorization', "Bearer {$tokenA}")->deleteJson('/api/v1/me/sessions');

        $response->assertOk()->assertJsonPath('message', 'Semua sesi berhasil di-logout.');

        // Lihat catatan forgetGuards() di test password di atas.
        Auth::forgetGuards();

        $this->withHeader('Authorization', "Bearer {$tokenA}")->getJson('/api/v1/me')->assertStatus(401);
    }
}
