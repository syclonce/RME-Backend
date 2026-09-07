<?php

namespace Modules\MedicalRecordCppt\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordCppt\Http\Requests\StoreCpptVerificationRequest;
use Modules\MedicalRecordCppt\Http\Resources\CpptVerificationResource;
use Modules\MedicalRecordCppt\Models\CpptVerification;
use Modules\PendaftaranVisit\Models\Visit;

class CpptVerificationController extends Controller
{
    public function index(Request $request)
    {
        $query = CpptVerification::query()->with('verifier');

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return CpptVerificationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    /**
     * Port VerifikasiCPPTResource:31-35 simgos2 (cekDPJPKunjungan): verifikasi
     * CPPT hanya oleh DPJP kunjungan itu — bukan PPA mana pun. Cakupan
     * per-kunjungan sampai BATAS_TANGGAL (valid_until), bukan per-baris.
     */
    public function store(StoreCpptVerificationRequest $request)
    {
        $data = $request->validated();
        $visit = Visit::query()->findOrFail((int) $data['visit_id']);

        $employeeId = Employee::query()->where('user_id', $request->user()->id)->value('id');
        abort_if($employeeId === null, 422, 'Akun Anda belum tertaut ke data pegawai.');
        abort_if(
            (int) $visit->attending_physician_id !== (int) $employeeId,
            403,
            'Verifikasi CPPT hanya dapat dilakukan oleh DPJP kunjungan ini.'
        );

        $verification = CpptVerification::create([
            ...$data,
            'verified_at' => now(),
            'verified_by' => $employeeId,
            'status' => 'verified',
        ]);

        return (new CpptVerificationResource($verification))->response()->setStatusCode(201);
    }

    public function show(CpptVerification $cppt_verification): CpptVerificationResource
    {
        return new CpptVerificationResource($cppt_verification->load('verifier'));
    }
}
