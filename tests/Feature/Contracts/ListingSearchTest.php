<?php

namespace Tests\Feature\Contracts;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Tests\TestCase;

/**
 * Endpoint daftar harus benar-benar menyaring `?name=`.
 *
 * Frontend memasang kotak pencarian di 563 halaman, tapi hanya sebagian kecil
 * controller yang membacanya. Diuji lewat HTTP sebelum perbaikan:
 *
 *     GET /diagnosis-codes?name=zzzz-tidak-ada  -> 5 baris (sama seperti tanpa filter)
 *
 * Pada tabel 40.807 baris yang paling membutuhkan pencarian. Ini lebih buruk
 * daripada tidak ada pencarian sama sekali: petugas mengetik, daftarnya tidak
 * berubah, dan tidak ada apa pun di layar yang menjelaskan kenapa.
 */
class ListingSearchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user, 'sanctum');
    }

    /**
     * @return array<string, array{0:string, 1:class-string}>
     */
    public static function searchableEndpoints(): array
    {
        return [
            'wards' => ['/api/v1/wards', \Modules\GeneralWard\Models\Ward::class],
            'services' => ['/api/v1/services', \Modules\GeneralService\Models\Service::class],
            'patients' => ['/api/v1/patients', \Modules\GeneralPatient\Models\Patient::class],
            'employees' => ['/api/v1/employees', \Modules\GeneralEmployee\Models\Employee::class],
        ];
    }

    /**
     * Baris DIBUAT lebih dulu, lalu dicari dengan kata kunci yang pasti tidak
     * cocok. Tanpa data, tabel kosong akibat RefreshDatabase membuat hasilnya
     * `[]` apa pun yang terjadi — tes hijau yang tidak menguji apa pun.
     * (Versi pertama tes ini persis begitu, dan ketahuan hanya karena
     * filternya sengaja dilumpuhkan untuk memeriksa apakah tesnya menangkap.)
     *
     * @param  class-string  $model
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('searchableEndpoints')]
    public function test_listing_honours_the_name_filter(string $endpoint, string $model): void
    {
        $model::factory()->count(3)->create();

        $this->getJson($endpoint.'?per_page=5')
            ->assertOk()
            ->assertJsonCount(3, 'data');

        $filtered = $this->getJson($endpoint.'?per_page=5&name=zzz-mustahil-cocok-zzz');
        $filtered->assertOk();

        $this->assertSame(
            [],
            $filtered->json('data'),
            "{$endpoint} mengabaikan `?name=`. Kotak pencarian di layar akan tampak rusak: "
            .'petugas mengetik, daftarnya tidak berubah, tanpa penjelasan apa pun.',
        );
    }
}
