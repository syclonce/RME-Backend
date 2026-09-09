<?php
namespace Modules\PembatalanReturnCancellation\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanReturnCancellation\Models\ReturnCancellation;
class PembatalanReturnCancellationController extends Controller {
    public function index() {
        return ReturnCancellation::query()->paginate(15);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'return_id' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string'],
            'cancellation_date' => ['required', 'date'],
            'requested_by' => ['required', 'string', 'max:255'],
        ]);
        // status TIDAK diterima dari klien saat create — catatan pembatalan
        // baru selalu mulai 'pending' (default kolom).
        $data['cancellation_number'] = ReturnCancellation::generateCancellationNumber();
        return response()->json(ReturnCancellation::create($data)->refresh(), 201);
    }
    public function show(ReturnCancellation $return_cancellation) {
        return $return_cancellation;
    }
    public function update(Request $request, ReturnCancellation $return_cancellation) {
        abort_if($return_cancellation->status === 'reversed', 422, 'Catatan pembatalan ini sudah dibalik; tidak dapat disunting.');

        $data = $request->validate([
            'reason' => ['sometimes', 'string'],
            'cancellation_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'in:pending,approved,rejected'],
        ]);
        $return_cancellation->update($data);
        return $return_cancellation;
    }
    /**
     * Bukan DELETE — catatan pembatalan adalah catatan beralasan (peta induk
     * Temuan 16), sehingga "menghapus" catatan pembatalan berarti membalik
     * (reverse) keputusan itu, bukan menghilangkan jejaknya dari database.
     */
    public function destroy(ReturnCancellation $return_cancellation) {
        abort_if($return_cancellation->status === 'reversed', 422, 'Catatan pembatalan ini sudah dibalik.');

        $return_cancellation->update(['status' => 'reversed']);

        return response()->json($return_cancellation->fresh());
    }
}
