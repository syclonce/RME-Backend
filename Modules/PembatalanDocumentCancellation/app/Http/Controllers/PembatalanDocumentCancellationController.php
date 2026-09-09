<?php
namespace Modules\PembatalanDocumentCancellation\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanDocumentCancellation\Models\DocumentCancellation;
class PembatalanDocumentCancellationController extends Controller {
    public function index() {
        return DocumentCancellation::query()->paginate(15);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'document_id' => ['required', 'string', 'max:255'],
            'document_type' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string'],
            'cancellation_date' => ['required', 'date'],
            'requested_by' => ['required', 'string', 'max:255'],
        ]);
        // status TIDAK diterima dari klien saat create — catatan pembatalan
        // baru selalu mulai 'pending' (default kolom).
        $data['cancellation_number'] = DocumentCancellation::generateCancellationNumber();
        return response()->json(DocumentCancellation::create($data)->refresh(), 201);
    }
    public function show(DocumentCancellation $document_cancellation) {
        return $document_cancellation;
    }
    public function update(Request $request, DocumentCancellation $document_cancellation) {
        abort_if($document_cancellation->status === 'reversed', 422, 'Catatan pembatalan ini sudah dibalik; tidak dapat disunting.');

        $data = $request->validate([
            'reason' => ['sometimes', 'string'],
            'cancellation_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'in:pending,approved,rejected'],
        ]);
        $document_cancellation->update($data);
        return $document_cancellation;
    }
    /**
     * Bukan DELETE — catatan pembatalan adalah catatan beralasan (peta induk
     * Temuan 16), sehingga "menghapus" catatan pembatalan berarti membalik
     * (reverse) keputusan itu, bukan menghilangkan jejaknya dari database.
     */
    public function destroy(DocumentCancellation $document_cancellation) {
        abort_if($document_cancellation->status === 'reversed', 422, 'Catatan pembatalan ini sudah dibalik.');

        $document_cancellation->update(['status' => 'reversed']);

        return response()->json($document_cancellation->fresh());
    }
}
