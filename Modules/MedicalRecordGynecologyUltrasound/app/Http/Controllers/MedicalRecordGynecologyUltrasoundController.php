<?php

namespace Modules\MedicalRecordGynecologyUltrasound\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class MedicalRecordGynecologyUltrasoundController extends Controller
{
    use GuardsMedicalRecord;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return response()->json([]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        return response()->json([]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        //

        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($id)]);

        //

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}
