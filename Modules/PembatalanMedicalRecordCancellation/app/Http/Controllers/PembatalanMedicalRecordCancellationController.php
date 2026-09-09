<?php
namespace Modules\PembatalanMedicalRecordCancellation\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanMedicalRecordCancellation\Models\MedicalRecordCancellation;
class PembatalanMedicalRecordCancellationController extends Controller {
    public function index() {
        return MedicalRecordCancellation::query()->paginate(15);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'medical_record_id' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string'],
            'cancellation_date' => ['required', 'date'],
            'requested_by' => ['required', 'string', 'max:255'],
        ]);
        // status TIDAK diterima dari klien saat create — catatan pembatalan
        // baru selalu mulai 'pending' (default kolom).
        $data['cancellation_number'] = MedicalRecordCancellation::generateCancellationNumber();
        return response()->json(MedicalRecordCancellation::create($data)->refresh(), 201);
    }
    public function show(MedicalRecordCancellation $medical_record_cancellation) {
        return $medical_record_cancellation;
    }
    public function update(Request $request, MedicalRecordCancellation $medical_record_cancellation) {
        abort_if($medical_record_cancellation->status === 'reversed', 422, 'Catatan pembatalan ini sudah dibalik; tidak dapat disunting.');

        $data = $request->validate([
            'reason' => ['sometimes', 'string'],
            'cancellation_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'in:pending,approved,rejected'],
        ]);
        $medical_record_cancellation->update($data);
        return $medical_record_cancellation;
    }
    /**
     * Bukan DELETE — catatan pembatalan adalah catatan beralasan (peta induk
     * Temuan 16), sehingga "menghapus" catatan pembatalan berarti membalik
     * (reverse) keputusan itu, bukan menghilangkan jejaknya dari database.
     */
    public function destroy(MedicalRecordCancellation $medical_record_cancellation) {
        abort_if($medical_record_cancellation->status === 'reversed', 422, 'Catatan pembatalan ini sudah dibalik.');

        $medical_record_cancellation->update(['status' => 'reversed']);

        return response()->json($medical_record_cancellation->fresh());
    }
}
