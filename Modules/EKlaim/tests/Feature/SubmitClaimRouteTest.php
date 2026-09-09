<?php

namespace Modules\EKlaim\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\EKlaim\Models\EklaimCall;
use Modules\EKlaim\Services\EklaimService;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;
use Modules\PembayaranInvoice\Models\Invoice;
use Tests\TestCase;

class SubmitClaimRouteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');
    }

    private function claim(string $status = 'draft'): ClaimInvoice
    {
        return ClaimInvoice::create([
            'invoice_id' => Invoice::factory()->create()->id,
            'claim_number' => 'CLM-'.uniqid(),
            'claim_amount' => 5_000_000,
            'status' => $status,
        ]);
    }

    private function fakeSuccess(): void
    {
        $this->app->bind(EklaimService::class, fn () => new class extends EklaimService
        {
            public function __construct()
            {
            }

            public function call(string $method, array $data = []): EklaimCall
            {
                return EklaimCall::create([
                    'method' => $method, 'request_data' => $data, 'status' => 'sent',
                ]);
            }
        });
    }

    public function test_submit_menjalankan_orkestrasi_dan_mengubah_status(): void
    {
        $this->fakeSuccess();
        $claim = $this->claim();

        $response = $this->postJson("/api/v1/eklaim/claims/{$claim->id}/submit", [
            'data' => ['nomor_sep' => '0001'],
        ]);

        $response->assertOk()
            ->assertJsonPath('claim.status', 'submitted')
            ->assertJsonCount(5, 'steps');
        $this->assertSame('submitted', $claim->fresh()->status);
    }

    public function test_submit_menolak_klaim_bukan_draft(): void
    {
        $this->fakeSuccess();
        $claim = $this->claim('submitted');

        $this->postJson("/api/v1/eklaim/claims/{$claim->id}/submit", [
            'data' => ['nomor_sep' => '0001'],
        ])->assertUnprocessable();
    }
}
