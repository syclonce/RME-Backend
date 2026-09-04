<?php

namespace Modules\PembatalanVisitCancellation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembatalanVisitCancellation\Http\Requests\StoreVisitCancellationRequest;
use Modules\PembatalanVisitCancellation\Http\Resources\VisitCancellationResource;
use Modules\PembatalanVisitCancellation\Models\VisitCancellation;
use Modules\PendaftaranVisit\Models\Visit;

class VisitCancellationController extends Controller
{
    public function index(Request $request)
    {
        $query = VisitCancellation::query();

        return VisitCancellationResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreVisitCancellationRequest $request)
    {
        $data = $request->validated();

        $visit = Visit::findOrFail($data['visit_id']);

        // Port precondition PembatalanKunjunganResource simgos2 (b.66-80):
        // kunjungan yang sudah difinalkan tidak dapat dibatalkan lewat jalur ini —
        // pembatalan sesudah final menyentuh tagihan yang mungkin sudah dikunci.
        abort_if(
            $visit->status === 'finalized',
            422,
            'Kunjungan sudah difinalkan; pembatalan harus lewat pembatalan final.',
        );

        // Satu kunjungan satu catatan pembatalan. Tanpa ini pembatalan dapat
        // dicatat berkali-kali untuk kunjungan yang sama, dan laporan pembatalan
        // menghitung ganda.
        abort_if(
            VisitCancellation::query()->where('visit_id', $visit->id)->exists(),
            422,
            'Kunjungan ini sudah memiliki catatan pembatalan.',
        );

        $data['cancelled_at'] ??= now();

        $visit_cancellation = VisitCancellation::create($data);

        return (new VisitCancellationResource($visit_cancellation))->response()->setStatusCode(201);
    }

    public function show(VisitCancellation $visit_cancellation): VisitCancellationResource
    {
        return new VisitCancellationResource($visit_cancellation);
    }
}
