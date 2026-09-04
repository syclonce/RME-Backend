<?php

namespace Modules\FinanceGeneralLedger\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\FinanceGeneralLedger\Http\Resources\AccountResource;
use Modules\FinanceGeneralLedger\Models\Account;

/**
 * Read-only (role:admin) — chart of accounts ditulis lewat seeder/migrasi
 * atau (nanti) modul admin khusus, bukan lewat endpoint publik.
 */
class AccountController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        $query = Account::query();

        if ($request->filled('type')) {
            $query->where('type', $request->string('type'));
        }

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return AccountResource::collection($query->orderBy('code')->paginate($request->integer('per_page', 15)));
    }

    public function show(Account $account): AccountResource
    {
        return new AccountResource($account);
    }
}
