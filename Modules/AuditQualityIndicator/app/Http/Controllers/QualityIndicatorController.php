<?php

namespace Modules\AuditQualityIndicator\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\AuditQualityIndicator\Http\Requests\StoreQualityIndicatorRequest;
use Modules\AuditQualityIndicator\Http\Requests\UpdateQualityIndicatorRequest;
use Modules\AuditQualityIndicator\Models\QualityIndicator;
use Modules\AuditQualityIndicator\Models\QualityIndicatorRecord;
use Modules\AuditQualityIndicator\Services\QualityIndicatorService;

class QualityIndicatorController extends Controller
{
    use SearchesListing;

    public function __construct(protected QualityIndicatorService $service) {}

    public function index(Request $request)
    {
        $query = QualityIndicator::query();

        if ($request->filled('category')) {
            $query->where('category', $request->query('category'));
        }

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return $query->orderBy('code')->paginate($request->integer('per_page', 15));
    }

    public function store(StoreQualityIndicatorRequest $request): JsonResponse
    {
        // Master indikator tanpa gerbang khusus selain unique code (validasi),
        // tetap lewat service agar pola tulis konsisten dan gerbang hapus
        // tidak bisa dilewati controller.
        return response()->json($this->service->create($request->validated())->refresh(), 201);
    }

    public function show(QualityIndicator $quality_indicator): QualityIndicator
    {
        return $quality_indicator;
    }

    public function update(UpdateQualityIndicatorRequest $request, QualityIndicator $quality_indicator): QualityIndicator
    {
        return $this->service->update($quality_indicator, $request->validated());
    }

    public function destroy(QualityIndicator $quality_indicator): JsonResponse
    {
        // Gerbang: ditolak bila masih ada catatan capaian (lihat service).
        $this->service->delete($quality_indicator);

        return response()->json(null, 204);
    }

    /**
     * Tren capaian tahunan: titik per bulan yang punya catatan, urut
     * period_month. Default tahun berjalan bila ?year= tidak dikirim.
     */
    public function trend(Request $request, QualityIndicator $quality_indicator): JsonResponse
    {
        $data = $request->validate([
            'year' => ['nullable', 'integer', 'between:2000,2100'],
        ]);

        $year = (int) ($data['year'] ?? now()->year);

        $records = $quality_indicator->records()
            ->where('period_year', $year)
            ->orderBy('period_month')
            ->get();

        // achieved_value ikut karena $appends pada model — angka capaian bulanan
        // siap dipakai grafik tanpa hitung ulang di frontend.
        return response()->json([
            'data' => $records->map(fn (QualityIndicatorRecord $record) => [
                'id' => $record->id,
                'period_month' => $record->period_month,
                'period_year' => $record->period_year,
                'numerator' => $record->numerator,
                'denominator' => $record->denominator,
                'achieved_value' => $record->achieved_value,
            ]),
            'meta' => [
                'indicator_id' => $quality_indicator->id,
                'year' => $year,
                'unit_of_measure' => $quality_indicator->unit_of_measure,
                'target_value' => $quality_indicator->target_value,
            ],
        ]);
    }
}
