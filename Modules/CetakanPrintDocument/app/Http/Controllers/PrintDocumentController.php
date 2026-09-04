<?php

namespace Modules\CetakanPrintDocument\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\CetakanPrintDocument\Models\PrintDocument;
use Modules\CetakanPrintDocument\Services\PrintDocumentService;

class PrintDocumentController extends Controller
{
    public function __construct(private readonly PrintDocumentService $documents)
    {
    }

    public function issue(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'document_type' => ['required', 'string', 'in:'.implode(',', PrintDocument::TYPES)],
            'ref_type' => ['required', 'string', 'max:30'],
            'ref_id' => ['required', 'integer'],
        ]);

        $result = $this->documents->issue(
            $validated['document_type'],
            $validated['ref_type'],
            (int) $validated['ref_id'],
            $request->user(),
        );

        return response()->json([
            'data' => [
                'document' => $result['document'],
                'reused' => $result['reused'],
            ],
        ], 201);
    }

    public function show(PrintDocument $document): JsonResponse
    {
        return response()->json(['data' => $document]);
    }

    public function pdf(PrintDocument $document): Response
    {
        abort_unless($document->document_type === PrintDocument::TYPE_PATIENT_CARD, 422, 'Cetak PDF baru tersedia untuk kartu pasien.');

        $html = $this->documents->renderPatientCardHtml($document);

        return Pdf::loadHTML($html)
            ->setPaper([0, 0, 300, 210], 'portrait')
            ->stream("{$document->document_number}.pdf");
    }

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => ['nullable', 'string', 'in:'.implode(',', PrintDocument::TYPES)],
            'date' => ['nullable', 'date'],
        ]);

        $query = PrintDocument::query()->with('issuedBy:id,name')->latest('id');
        if ($validated['type'] ?? null) {
            $query->where('document_type', $validated['type']);
        }
        if ($validated['date'] ?? null) {
            // Nomor seri memakai stempel tanggal — filter langsung dari pola nomor.
            $stamp = \Illuminate\Support\Carbon::parse($validated['date'])->format('ymd');
            $prefixes = array_values(PrintDocument::PREFIXES);
            $query->where(function ($q) use ($prefixes, $stamp): void {
                foreach ($prefixes as $i => $prefix) {
                    $method = $i === 0 ? 'where' : 'orWhere';
                    $q->{$method}('document_number', 'like', "{$prefix}-{$stamp}-%");
                }
            });
        }

        return response()->json(['data' => $query->paginate(min(100, (int) $request->input('per_page', 15)))]);
    }
}
