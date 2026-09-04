<?php

namespace Modules\LayananMedicalProcedure\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\BillingGate;
use App\Modules\Contracts\HospitalConfig;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;
use Modules\LayananMedicalProcedure\Http\Requests\StoreMedicalProcedureRequest;
use Modules\LayananMedicalProcedure\Http\Requests\UpdateMedicalProcedureRequest;
use Modules\LayananMedicalProcedure\Http\Resources\MedicalProcedureResource;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\LayananMedicalProcedure\Services\MedicalProcedureService;
use Modules\PendaftaranVisit\Models\Visit;

class MedicalProcedureController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalProcedure::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return MedicalProcedureResource::collection($query->latest('performed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(
        StoreMedicalProcedureRequest $request,
        MedicalRecordGate $medicalRecordGate,
        BillingGate $billingGate,
        HospitalConfig $config,
    ) {
        $data = $request->validated();

        // Gerbang RME, sama seperti Prescription/Diagnosis/ClinicalNote. Sebelumnya
        // modul ini melewatkannya, sehingga tindakan masih bisa dicatat pada rekam
        // medis yang sudah difinalkan — persis lubang yang membuat catatan klinis
        // legacy dapat berubah tanpa jejak.
        $medicalRecordGate->assertWritable((int) $data['visit_id'], $request->user());

        // Port gerbang TindakanMedisResource.php:41-43 simgos2 (config 69 =
        // KUNCI_SEMUA_TRANSAKSI_SEBELUM_DI_FINAL_TAGIHAN): begitu kasir mengunci
        // tagihan kunjungan, tindakan medis baru tidak boleh diinput lagi — kalau
        // masih bisa, tagihan yang sudah "final" berubah diam-diam. Sama seperti
        // VisitService::assertNotBillingLocked, gerbang ini tunduk pada flag
        // konfigurasi RS, bukan hardcode aktif.
        if ($config->get('billing.lock_on_cashier_close', true)) {
            abort_if(
                $billingGate->isVisitLocked((int) $data['visit_id']),
                422,
                'Tagihan kunjungan ini sudah dikunci oleh kasir; tindakan baru tidak dapat dicatat.',
            );
        }

        $data['performed_at'] ??= now();

        // Port aturan TindakanMedisResource::create simgos2 (b.31-38): tanggal
        // tindakan tidak boleh melewati tanggal pasien pulang. Tanpa ini tagihan
        // dapat bertambah setelah pasien meninggalkan rumah sakit.
        $visit = Visit::find($data['visit_id']);
        if ($visit?->discharged_at !== null && $data['performed_at'] > $visit->discharged_at) {
            abort(422, 'Tanggal tindakan tidak boleh melewati tanggal pulang pasien ('
                .$visit->discharged_at->format('d-m-Y H:i').').');
        }

        // Tindakan selalu lahir 'completed' — dicatat setelah dilakukan, bukan
        // dipesan lebih dulu. Status dari klien diabaikan supaya tindakan tidak
        // bisa langsung dicatat sebagai 'cancelled'.
        $data['status'] = 'completed';
        $data['created_by'] = $request->user()->id;

        $procedure = MedicalProcedure::create($data);

        return (new MedicalProcedureResource($procedure))->response()->setStatusCode(201);
    }

    public function show(MedicalProcedure $medical_procedure): MedicalProcedureResource
    {
        return new MedicalProcedureResource($medical_procedure);
    }

    /**
     * Only status/notes are correctable - what was done and when is not.
     */
    /**
     * Perubahan status tindakan lewat state machine, bukan update bebas.
     *
     * Sebelumnya `update()` menerima status apa pun yang lolos `Rule::in`,
     * termasuk mengembalikan tindakan `cancelled` menjadi `completed` — yang
     * mengaburkan apa yang benar-benar dikerjakan pada pasien.
     */
    public function update(
        UpdateMedicalProcedureRequest $request,
        MedicalProcedure $medical_procedure,
        MedicalProcedureService $service,
    ): MedicalProcedureResource {
        $data = $request->validated();

        return new MedicalProcedureResource(
            $service->transition($medical_procedure, $data['status'], $request->user())
        );
    }
}
