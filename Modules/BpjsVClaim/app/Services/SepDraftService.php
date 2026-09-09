<?php

namespace Modules\BpjsVClaim\Services;

use Illuminate\Validation\ValidationException;
use Modules\BpjsVClaim\Models\Sep;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;

/**
 * Susun draf SEP dari data pendaftaran yang sudah ada.
 *
 * Sebelumnya SEP hanya dapat dibuat sebagai CRUD lepas: petugas mengetik ulang
 * nomor kartu, poli tujuan, dan kelas rawat yang seluruhnya sudah tersimpan saat
 * pendaftaran. Selain memboroskan waktu, pengetikan ulang adalah sumber selisih
 * data antara SEP dan rekam pendaftaran — dan selisih itu baru ketahuan saat
 * klaim ditolak BPJS.
 *
 * Service ini TIDAK memanggil BPJS. Ia hanya menyiapkan draf yang benar; penerbitan
 * nomor SEP ke VClaim tetap langkah terpisah, sehingga kegagalan jaringan tidak
 * membatalkan pendaftaran yang sudah sah.
 */
class SepDraftService
{
    public function draftFromRegistration(Registration $registration): Sep
    {
        // SEP hanya untuk peserta BPJS. Pasien umum atau asuransi lain tidak
        // pernah punya SEP, dan membuatkannya akan menghasilkan draf yang tidak
        // mungkin diterbitkan.
        $guarantor = Guarantor::query()
            ->where('registration_id', $registration->id)
            ->where('payer_type', 'bpjs')
            ->orderBy('id')
            ->first();

        if ($guarantor === null) {
            throw ValidationException::withMessages([
                'registration_id' => 'Pendaftaran ini tidak memiliki penjamin BPJS, SEP tidak dapat dibuat.',
            ]);
        }

        $existing = Sep::query()->where('registration_id', $registration->id)->first();

        if ($existing !== null) {
            throw ValidationException::withMessages([
                'registration_id' => 'Pendaftaran ini sudah memiliki SEP (#'.$existing->id.').',
            ]);
        }

        $destination = VisitDestination::query()
            ->where('registration_id', $registration->id)
            ->first();

        return Sep::create([
            'registration_id' => $registration->id,
            'patient_id' => $registration->patient_id,
            'no_kartu' => $guarantor->member_number,
            'tgl_sep' => $registration->registered_at?->toDateString() ?? now()->toDateString(),

            // Rawat jalan bila tidak ada ruangan tujuan rawat inap — sejalan dengan
            // penanda yang dipakai seluruh alur (ward_id null = rawat jalan).
            'visit_type' => $registration->is_emergency ? 'darurat' : 'rawat_jalan',

            'poli_tujuan' => $destination?->ward_id !== null ? (string) $destination->ward_id : null,
            'kelas_rawat' => $guarantor->room_class_id !== null ? (string) $guarantor->room_class_id : null,
            'no_rujukan' => $guarantor->reference_letter_number,
            'local_status' => 'draft',
        ]);
    }
}
