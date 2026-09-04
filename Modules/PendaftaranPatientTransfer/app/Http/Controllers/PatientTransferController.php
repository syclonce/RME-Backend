<?php

namespace Modules\PendaftaranPatientTransfer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranPatientTransfer\Http\Requests\StorePatientTransferRequest;
use Modules\PendaftaranPatientTransfer\Http\Resources\PatientTransferResource;
use Modules\PendaftaranPatientTransfer\Models\PatientTransfer;

/**
 * PERINGATAN — jangan dikembangkan sebagai jalur mutasi pasien.
 *
 * Mutasi pasien yang SEBENARNYA ditangani `VisitService::transfer()`
 * (`Modules/PendaftaranVisit`, rute `POST /visits/{visit}/transfer`), yang
 * menempati bed tujuan secara atomik, mencatat riwayat `VisitTransfer`, lalu
 * membebaskan bed lama. Controller ini adalah CRUD sisa scaffold: ia menulis
 * `patient_transfers` TANPA gerbang bed sama sekali, sehingga memakainya akan
 * menghasilkan bed ganda-huni dan riwayat mutasi yang terpecah dua tabel.
 *
 * Kedua tabel masih kosong (0 baris). Selama belum ada keputusan menghapus modul
 * ini, jangan menambah logika di sini — tambahkan ke `VisitService::transfer()`.
 *
 * Lihat `docs-sim/histori/catatan/2026-09-04-audit-kesiapan-enam-alur.md`.
 */
class PatientTransferController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientTransfer::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PatientTransferResource::collection($query->latest('transferred_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientTransferRequest $request)
    {
        $data = $request->validated();
        $data['transferred_at'] ??= now();

        $transfer = PatientTransfer::create($data);

        return (new PatientTransferResource($transfer))->response()->setStatusCode(201);
    }

    public function show(PatientTransfer $patienttransfer): PatientTransferResource
    {
        return new PatientTransferResource($patienttransfer);
    }
}
