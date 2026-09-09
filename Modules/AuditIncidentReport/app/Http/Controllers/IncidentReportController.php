<?php

namespace Modules\AuditIncidentReport\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\AuditIncidentReport\Http\Requests\StoreIncidentReportRequest;
use Modules\AuditIncidentReport\Http\Requests\UpdateIncidentReportRequest;
use Modules\AuditIncidentReport\Http\Resources\IncidentReportResource;
use Modules\AuditIncidentReport\Models\IncidentReport;
use Modules\AuditIncidentReport\Services\IncidentReportService;

class IncidentReportController extends Controller
{
    use SearchesListing;

    use ResolvesActingEmployee;

    public function __construct(protected IncidentReportService $service) {}

    /** Baca: semua staf terautentikasi. Filter kategori/status/grade opsional. */
    public function index(Request $request): AnonymousResourceCollection
    {
        $reports = IncidentReport::query()
            ->with(['patient:id,medical_record_number,name', 'visit:id,visit_number', 'reportedBy:id,name'])
            ->when($request->filled('incident_category'), fn ($q) => $q->where('incident_category', $request->string('incident_category')))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('risk_grade'), fn ($q) => $q->where('risk_grade', $request->string('risk_grade')))
            ->latest('occurred_at');

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini
        // filternya diabaikan diam-diam saat petugas mengetik. Harus SEBELUM
        // paginate(): sesudahnya yang tersisa paginator, bukan builder.
        $reports = $this->applySearch($reports, $request)
            ->paginate($request->integer('per_page', 15));

        return IncidentReportResource::collection($reports);
    }

    public function show(IncidentReport $incidentReport): IncidentReportResource
    {
        return new IncidentReportResource($incidentReport->load(['patient', 'visit', 'reportedBy']));
    }

    /** Tulis: petugas|admin (gerbang role di routes). Kalkulasi di service. */
    public function store(StoreIncidentReportRequest $request): JsonResponse
    {
        // risk_grade & sla_due_at lahir dari IncidentReportService::create(),
        // bukan dari payload — controller dilarang create() model langsung.
        $report = $this->service->create($this->fillActingEmployee($request, $request->validated(), 'reported_by'));

        return (new IncidentReportResource($report))->response()->setStatusCode(201);
    }

    public function update(UpdateIncidentReportRequest $request, IncidentReport $incidentReport): IncidentReportResource
    {
        $report = $this->service->updateDetails($incidentReport, $request->validated());

        return new IncidentReportResource($report);
    }

    /** Transisi reported → under_investigation. */
    public function investigate(IncidentReport $incidentReport): IncidentReportResource
    {
        return new IncidentReportResource($this->service->startInvestigation($incidentReport));
    }

    /** Transisi under_investigation → rca_required. */
    public function requireRca(IncidentReport $incidentReport): IncidentReportResource
    {
        return new IncidentReportResource($this->service->markRcaRequired($incidentReport));
    }

    /** Transisi under_investigation|rca_required → closed. */
    public function close(IncidentReport $incidentReport): IncidentReportResource
    {
        return new IncidentReportResource($this->service->close($incidentReport));
    }

    /**
     * Sengaja TIDAK ada destroy(): laporan IKP adalah rekaman audit
     * keselamatan pasien — tidak boleh dihapus via API.
     */
}
