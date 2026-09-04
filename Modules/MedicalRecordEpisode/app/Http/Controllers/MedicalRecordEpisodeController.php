<?php

namespace Modules\MedicalRecordEpisode\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\PendaftaranVisit\Models\Visit;

class MedicalRecordEpisodeController extends Controller
{
    public function show(Visit $visit)
    {
        return response()->json(['data' => MedicalRecordEpisode::query()
            ->where('visit_id', $visit->id)->with('transitions')->first()]);
    }

    public function start(Request $request, Visit $visit, MedicalRecordGate $gate)
    {
        return response()->json(['data' => $gate->start($visit->id, $request->user())], 201);
    }

    public function finalize(Request $request, Visit $visit, MedicalRecordGate $gate)
    {
        return response()->json(['data' => $gate->finalize($visit->id, $request->user())]);
    }

    public function amend(Request $request, Visit $visit, MedicalRecordGate $gate)
    {
        $data = $request->validate(['reason' => ['required', 'string', 'max:2000']]);

        return response()->json(['data' => $gate->beginAmendment($visit->id, $request->user(), $data['reason'])]);
    }
}
