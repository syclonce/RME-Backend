<?php

namespace Modules\BpjsAntreanRs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * kodepoli/kodedokter sekarang OPSIONAL: bila tidak dipasok, AntreanDraftService
 * menurunkannya dari tabel pemetaan antrean_rs_bpjs_code_mappings (lihat
 * catatan di AntreanDraftService). Tetap boleh dipasok manual untuk override
 * sementara. Field lain yang memang tersedia secara internal (nomorkartu,
 * norm, nama, tanggal, nomor antrean) TIDAK diminta di sini — seluruhnya
 * diturunkan dari VisitDestination oleh service.
 */
class StoreAntreanFromDestinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_destination_id' => ['required', 'integer', 'exists:visit_destinations,id'],
            'kodepoli' => ['nullable', 'string', 'max:10'],
            'kodedokter' => ['nullable', 'integer'],
        ];
    }
}
