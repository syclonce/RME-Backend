<?php

namespace Modules\PembayaranInvoice\Tests\Feature;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Bukti RBAC dinamis (migrasi pilot #PembayaranInvoice): gerbang
 * role:petugas|admin & role:admin lama sudah dihapus dari routes/api.php.
 * invoices.unlock tetap admin-only karena legacy_tier admin_only (cuma role
 * admin yang di-grant baseline) -- bukan lagi hardcode role:admin di rute.
 */
class InvoiceRoutePermissionGateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_role_kustom_tanpa_permission_tidak_bisa_unlock_invoice(): void
    {
        $role = Role::create(['name' => 'kasir', 'guard_name' => config('auth.defaults.guard')]);
        $role->givePermissionTo('pembayaran-invoice.invoice-guarantor.lock'); // punya lock, TIDAK unlock
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user, 'sanctum');

        $invoice = Invoice::factory()->locked()->create();

        $this->postJson("/api/v1/invoices/{$invoice->id}/unlock")->assertStatus(403);
    }

    public function test_petugas_tetap_tidak_bisa_unlock_persis_seperti_sebelum_migrasi(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $this->actingAs($user, 'sanctum');

        $invoice = Invoice::factory()->locked()->create();

        $this->postJson("/api/v1/invoices/{$invoice->id}/unlock")->assertStatus(403);
    }

    public function test_admin_tetap_bisa_unlock_invoice(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user, 'sanctum');

        $invoice = Invoice::factory()->create(['is_locked' => true]);

        $this->postJson("/api/v1/invoices/{$invoice->id}/unlock")->assertOk();
    }

    public function test_admin_tidak_bisa_unlock_invoice_lunas(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user, 'sanctum');

        $invoice = Invoice::factory()->locked()->create();

        // Lolos gerbang RBAC (admin) tapi ditolak gerbang domain 422 —
        // invoice lunas hanya lewat reversal/refund (legacy TagihanResource:157).
        $this->postJson("/api/v1/invoices/{$invoice->id}/unlock")->assertStatus(422);
    }
}
