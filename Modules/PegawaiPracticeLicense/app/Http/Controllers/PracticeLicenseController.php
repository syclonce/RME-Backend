<?php

namespace Modules\PegawaiPracticeLicense\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PegawaiPracticeLicense\Http\Requests\StorePracticeLicenseRequest;
use Modules\PegawaiPracticeLicense\Http\Requests\UpdatePracticeLicenseRequest;
use Modules\PegawaiPracticeLicense\Http\Resources\PracticeLicenseResource;
use Modules\PegawaiPracticeLicense\Models\PracticeLicense;

class PracticeLicenseController extends Controller
{
    public function index(Request $request)
    {
        $query = PracticeLicense::query();

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->integer('employee_id'));
        }

        return PracticeLicenseResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePracticeLicenseRequest $request)
    {
        $data = $request->validated();

        // SIP yang sudah lewat masa berlakunya tidak boleh dicatat sebagai izin
        // baru — dokter dengan SIP kedaluwarsa praktik tanpa dasar hukum, dan
        // sistem tidak boleh ikut menyatakan sebaliknya.
        abort_if(
            ! empty($data['expires_at']) && $data['expires_at'] < now()->toDateString(),
            422,
            'Masa berlaku izin sudah lewat; tidak dapat dicatat sebagai izin baru.',
        );

        // Satu jenis izin yang masih berlaku per pegawai. Nomor SIP ganda membuat
        // verifikasi ke konsil kesehatan menemukan dua jawaban berbeda.
        abort_if(
            PracticeLicense::query()
                ->where('employee_id', $data['employee_id'])
                ->where('license_type', $data['license_type'])
                ->where(fn ($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>=', now()->toDateString()))
                ->exists(),
            422,
            'Pegawai ini sudah memiliki izin jenis tersebut yang masih berlaku.',
        );

        $license = PracticeLicense::create($data);

        return (new PracticeLicenseResource($license))->response()->setStatusCode(201);
    }

    public function show(PracticeLicense $practiceLicense): PracticeLicenseResource
    {
        return new PracticeLicenseResource($practiceLicense);
    }

    public function update(UpdatePracticeLicenseRequest $request, PracticeLicense $practiceLicense): PracticeLicenseResource
    {
        $practiceLicense->update($request->validated());

        return new PracticeLicenseResource($practiceLicense);
    }
}
