<?php

namespace Modules\PegawaiEmployeeIdentityCard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PegawaiEmployeeIdentityCard\Http\Requests\StoreEmployeeIdentityCardRequest;
use Modules\PegawaiEmployeeIdentityCard\Http\Requests\UpdateEmployeeIdentityCardRequest;
use Modules\PegawaiEmployeeIdentityCard\Http\Resources\EmployeeIdentityCardResource;
use Modules\PegawaiEmployeeIdentityCard\Models\EmployeeIdentityCard;

class EmployeeIdentityCardController extends Controller
{
    public function index(Request $request)
    {
        $query = EmployeeIdentityCard::query();

        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->integer('employee_id'));
        }

        return EmployeeIdentityCardResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEmployeeIdentityCardRequest $request)
    {
        $data = $request->validated();

        // Satu jenis identitas satu kali per pegawai. Dua KTP dengan nomor berbeda
        // untuk orang yang sama membuat verifikasi identitas menemukan dua jawaban,
        // dan pencocokan ke Dukcapil/SATUSEHAT jadi tidak menentu.
        abort_if(
            EmployeeIdentityCard::query()
                ->where('employee_id', $data['employee_id'])
                ->where('id_type', $data['id_type'])
                ->exists(),
            422,
            'Pegawai ini sudah memiliki identitas jenis tersebut.',
        );

        $card = EmployeeIdentityCard::create($data);

        return (new EmployeeIdentityCardResource($card))->response()->setStatusCode(201);
    }

    public function show(EmployeeIdentityCard $employeeIdentityCard): EmployeeIdentityCardResource
    {
        return new EmployeeIdentityCardResource($employeeIdentityCard);
    }

    public function update(UpdateEmployeeIdentityCardRequest $request, EmployeeIdentityCard $employeeIdentityCard): EmployeeIdentityCardResource
    {
        $employeeIdentityCard->update($request->validated());

        return new EmployeeIdentityCardResource($employeeIdentityCard);
    }

    public function destroy(EmployeeIdentityCard $employeeIdentityCard)
    {
        $employeeIdentityCard->delete();

        return response()->noContent();
    }
}
