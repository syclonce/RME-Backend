<?php

namespace Modules\GeneralPatient\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;

class PatientResource extends JsonResource
{
    /**
     * Set true only by PatientController::show() — endpoint index/list
     * TIDAK mengaktifkan ini supaya listing tetap ringan (query ke
     * satu_sehat_staging_submissions per-baris akan jadi N+1 kalau dipaksa
     * tampil di index).
     */
    public bool $withSatuSehatStatus = false;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'medical_record_number' => $this->medical_record_number,
            'nik' => $this->nik,
            'no_bpjs' => $this->no_bpjs,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'title_prefix' => $this->title_prefix,
            'title_suffix' => $this->title_suffix,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date?->toDateString(),
            'gender_id' => $this->gender_id,
            'religion_id' => $this->religion_id,
            'address' => $this->address,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'postal_code' => $this->postal_code,
            'village_id' => $this->village_id,
            'education_id' => $this->education_id,
            'occupation_id' => $this->occupation_id,
            'marital_status_id' => $this->marital_status_id,
            'blood_type_id' => $this->blood_type_id,
            'nationality_id' => $this->nationality_id,
            'ethnicity_id' => $this->ethnicity_id,
            'language_id' => $this->language_id,
            'is_unidentified' => $this->is_unidentified,
            'patient_status_id' => $this->patient_status_id,
            'patient_type_id' => $this->patient_type_id,
            'registered_by' => $this->registered_by,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
            $this->mergeWhen($this->withSatuSehatStatus, fn () => $this->satuSehatStatusFields()),
        ];
    }

    /**
     * Status sinkronisasi SATUSEHAT itu murni DERIVED dari outbox
     * satu_sehat_staging_submissions (transactional outbox — lihat
     * Modules/SatuSehat), bukan kolom di tabel patients. Response eksternal
     * BUKAN source of truth data klinis/finansial internal (CLAUDE.md) —
     * di sini cuma dibaca status + id terakhir, tidak pernah ditulis balik.
     * Tidak ada row sama sekali = belum pernah disubmit ('not_submitted'),
     * dibedakan dari 'pending' (sudah ada submission, belum terkirim).
     */
    private function satuSehatStatusFields(): array
    {
        $submission = SatuSehatStagingSubmission::query()
            ->where('source_type', \Modules\GeneralPatient\Models\Patient::class)
            ->where('source_id', $this->id)
            ->orderByDesc('id')
            ->first();

        return [
            'satusehat_sync_status' => $submission->status ?? 'not_submitted',
            'satusehat_id' => $submission->satusehat_id ?? null,
        ];
    }
}
