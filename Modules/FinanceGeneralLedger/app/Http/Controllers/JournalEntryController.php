<?php

namespace Modules\FinanceGeneralLedger\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\FinanceGeneralLedger\Http\Resources\JournalEntryResource;
use Modules\FinanceGeneralLedger\Models\JournalEntry;

/**
 * Read-only (role:admin) — jurnal HANYA ditulis lewat
 * AccountingService::postEntry() (mis. dipicu listener
 * PostInvoiceLockedToLedger), tidak pernah lewat endpoint POST publik.
 */
class JournalEntryController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        $query = JournalEntry::query()->with('lines.account');

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini
        // filternya diabaikan diam-diam saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        if ($request->filled('source_type')) {
            $query->where('source_type', $request->string('source_type'));
        }

        if ($request->filled('source_id')) {
            $query->where('source_id', $request->integer('source_id'));
        }

        return JournalEntryResource::collection(
            $query->orderByDesc('date')->orderByDesc('id')->paginate($request->integer('per_page', 15)),
        );
    }

    public function show(JournalEntry $journal_entry): JournalEntryResource
    {
        return new JournalEntryResource($journal_entry->load('lines.account'));
    }
}
