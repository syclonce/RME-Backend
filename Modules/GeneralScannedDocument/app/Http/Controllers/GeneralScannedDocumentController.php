<?php

namespace Modules\GeneralScannedDocument\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\GeneralEmployee\Models\Employee;
use Illuminate\Http\Request;
use Modules\GeneralScannedDocument\Http\Requests\StoreScannedDocumentRequest;
use Modules\GeneralScannedDocument\Http\Resources\ScannedDocumentResource;
use Modules\GeneralScannedDocument\Models\ScannedDocument;

class GeneralScannedDocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = ScannedDocument::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return ScannedDocumentResource::collection($query->latest('scanned_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Scanned documents are append-only records - no update/delete.
     */
    public function store(StoreScannedDocumentRequest $request)
    {
        $data = $request->validated();

        // Waktu dan pelaku pemindaian diisi server. Dokumen pindaian adalah bukti
        // — bila waktunya bisa ditentukan klien, jejaknya kehilangan nilai sebagai
        // bukti kapan berkas itu benar-benar masuk.
        $data['scanned_at'] ??= now();
        // `scanned_by` menunjuk employees, bukan users — dipetakan lewat profil
        // pegawai user login (konvensi yang sama dipakai LabAnalyzerOrderService).
        // Dibiarkan null bila user belum punya profil pegawai; kolomnya nullable.
        $data['scanned_by'] ??= Employee::query()->where('user_id', $request->user()?->id)->value('id');

        $document = ScannedDocument::create($data);

        return (new ScannedDocumentResource($document))->response()->setStatusCode(201);
    }

    public function show(ScannedDocument $scannedDocument): ScannedDocumentResource
    {
        return new ScannedDocumentResource($scannedDocument);
    }
}
