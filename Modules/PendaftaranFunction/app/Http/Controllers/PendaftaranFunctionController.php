<?php

namespace Modules\PendaftaranFunction\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\PendaftaranFunction\Models\RegistrationFunction;

class PendaftaranFunctionController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(RegistrationFunction::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:registration_functions,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(RegistrationFunction::create($data)->refresh(), 201);
    }

    public function show(RegistrationFunction $registration_function): RegistrationFunction
    {
        return $registration_function;
    }

    public function update(Request $request, RegistrationFunction $registration_function): RegistrationFunction
    {
        $data = $request->validate([
            'code' => ['sometimes', 'string', 'max:50', Rule::unique('registration_functions', 'code')->ignore($registration_function->id)],
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $registration_function->update($data);

        return $registration_function;
    }

    public function destroy(RegistrationFunction $registration_function)
    {
        $registration_function->delete();

        return response()->json(null, 204);
    }
}
