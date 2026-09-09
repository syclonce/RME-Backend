<?php

namespace Modules\PembatalanFinalResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanFinalResult\Models\FinalResult;
use Modules\PembatalanFinalResult\Services\FinalResultCancellationService;

class PembatalanFinalResultController extends Controller
{
    public function index()
    {
        return FinalResult::query()->paginate(15);
    }

    /**
     * CATATAN: modul ini SENGAJA tidak memakai GuardsMedicalRecord.
     *
     * Gerbang itu menolak penulisan pada RME yang sudah final -- padahal RME
     * final justru satu-satunya yang punya final hasil untuk dibatalkan.
     * Memasangnya di sini membuat modul pembatalan menolak setiap pembatalan
     * yang sah. Preconditionnya ditegakkan FinalResultCancellationService,
     * yang menuntut kebalikannya: RME HARUS sudah final.
     */
    public function store(Request $request, FinalResultCancellationService $service)
    {
        $data = $request->validate([
            'visit_id' => ['required', 'exists:visits,id'],
            'reason' => ['required', 'string'],
            'cancellation_date' => ['required', 'date'],
            'requested_by' => ['required', 'string', 'max:255'],
        ]);

        return response()->json($service->cancel($data, $request->user()), 201);
    }

    public function show(FinalResult $final_result)
    {
        return $final_result;
    }

    /**
     * Hanya alasan dan tanggal yang dapat diperbaiki. Status TIDAK dapat
     * diubah lewat sini: statusnya adalah cerminan apa yang sudah terjadi
     * pada RME, bukan kolom yang boleh dikarang petugas. Membiarkan klien
     * menulis 'applied' akan membuat catatan mengaku RME terbuka padahal
     * tidak ada yang pernah membukanya.
     */
    public function update(Request $request, FinalResult $final_result)
    {
        abort_if(
            $final_result->status === FinalResult::STATUS_REVERSED,
            422,
            'Catatan pembatalan ini sudah dibalik; tidak dapat disunting.',
        );

        $final_result->update($request->validate([
            'reason' => ['sometimes', 'string'],
            'cancellation_date' => ['sometimes', 'date'],
        ]));

        return $final_result;
    }

    /**
     * Bukan DELETE -- catatan pembatalan adalah catatan beralasan (peta induk
     * Temuan 16), sehingga "menghapus" berarti membalik keputusan itu, bukan
     * menghilangkan jejaknya.
     *
     * Yang dibalik hanyalah catatannya. RME yang sudah terlanjur dibuka TIDAK
     * ikut ditutup kembali: menutupnya berarti memfinalkan ulang, dan itu
     * keputusan klinis milik dokter lewat jalur finalize -- bukan efek samping
     * dari membatalkan sebuah catatan administratif.
     */
    public function destroy(FinalResult $final_result)
    {
        abort_if(
            $final_result->status === FinalResult::STATUS_REVERSED,
            422,
            'Catatan pembatalan ini sudah dibalik.',
        );

        $final_result->update(['status' => FinalResult::STATUS_REVERSED]);

        return response()->json($final_result->fresh());
    }
}
