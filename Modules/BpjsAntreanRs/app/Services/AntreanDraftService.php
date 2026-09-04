<?php

namespace Modules\BpjsAntreanRs\Services;

use Illuminate\Validation\ValidationException;
use Modules\BpjsAntreanRs\Models\Antrean;
use Modules\BpjsAntreanRs\Models\BpjsCodeMapping;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;
use Modules\PendaftaranWardQueue\Models\WardQueue;

/**
 * Susun draf antrean BPJS (antrean_rs_antreans) dari sebuah VisitDestination
 * yang sudah ada, alih-alih petugas mengetik ulang kodepoli/kodedokter/
 * tanggalperiksa/nomorantrean secara manual di form terpisah.
 *
 * Padanan legacy: trigger `onAfterInsertTujuanPasien` yang menyisipkan antrean
 * lokal DAN nomor antrean BPJS begitu tujuan pasien dibuat — jadi antrean BPJS
 * memang seharusnya DITURUNKAN dari tujuan pasien, bukan sumber kebenaran baru.
 *
 * KETERBATASAN SUDAH DISELESAIKAN (2026-09-04): kodepoli/kodedokter sekarang
 * diturunkan dari tabel pemetaan antrean_rs_bpjs_code_mappings (lihat
 * Modules\BpjsAntreanRs\Models\BpjsCodeMapping dan BpjsCodeMappingService)
 * bila pemanggil TIDAK memasok kodepoli/kodedokter secara eksplisit. Kalau
 * pemetaan aktif untuk ward/dokter tujuan belum ada, draf DITOLAK (422) —
 * bukan dikirim kosong/asal ke BPJS. Pemanggil masih BOLEH memasok kodepoli/
 * kodedokter manual (mis. override sementara), dalam hal ini pemetaan tidak
 * dicek.
 *
 * Service ini TIDAK memanggil BPJS — hanya menyiapkan draf lokal yang benar,
 * sejalan dengan pola Modules/BpjsVClaim/app/Services/SepDraftService.php.
 */
class AntreanDraftService
{
    public function draftFromDestination(VisitDestination $destination, ?string $kodepoli = null, ?int $kodedokter = null): Antrean
    {
        $registration = $destination->registration;

        // Antrean Online BPJS hanya berlaku untuk peserta JKN. Pasien umum/asuransi
        // lain tidak pernah punya antrean BPJS — membuatkannya akan menghasilkan
        // draf yang tidak mungkin diterbitkan ke WS BPJS.
        $guarantor = Guarantor::query()
            ->where('registration_id', $registration->id)
            ->where('payer_type', 'bpjs')
            ->orderBy('id')
            ->first();

        if ($guarantor === null) {
            throw ValidationException::withMessages([
                'visit_destination_id' => 'Pendaftaran ini tidak memiliki penjamin BPJS, antrean BPJS tidak dapat dibuat.',
            ]);
        }

        // Idempoten: satu tujuan pasien hanya boleh menghasilkan satu antrean BPJS,
        // sama seperti aturan satu tujuan per pendaftaran pada VisitDestination itu
        // sendiri (unique registration_id). Karena Antrean tidak (dan tidak perlu)
        // menyimpan visit_destination_id, penautan dicek lewat kodebooking turunan
        // deterministik dari registration_id — lihat deterministicKodebooking().
        $existing = Antrean::query()
            ->where('kodebooking', $this->deterministicKodebooking($registration->id))
            ->first();

        if ($existing !== null) {
            throw ValidationException::withMessages([
                'visit_destination_id' => 'Tujuan pasien ini sudah memiliki draf antrean BPJS (#'.$existing->id.').',
            ]);
        }

        $ward = $destination->ward;
        $doctor = $destination->doctor;

        // Turunkan kodepoli/kodedokter dari pemetaan bila pemanggil tidak
        // memasoknya secara eksplisit. Tanpa pemetaan aktif, draf DITOLAK —
        // mengirim kodepoli/kodedokter kosong/asal ke BPJS akan menghasilkan
        // booking yang salah sasaran di sisi BPJS.
        if ($kodepoli === null) {
            $kodepoli = $this->resolveWardCode($ward);
        }

        if ($kodedokter === null) {
            $kodedokter = $this->resolveEmployeeCode($doctor);
        }

        // Nomor antrean TIDAK dibuat ulang di sini — WardQueueService adalah satu-
        // satunya penomor (lihat larangan menyentuh modul itu). Draf BPJS hanya
        // membaca nomor yang sudah ada, sama seperti legacy yang membaca nomor
        // dari `antrian_ruangan` saat mengisi payload `antrean/add`.
        $wardQueue = WardQueue::query()
            ->where('registration_id', $registration->id)
            ->where('ward_id', $destination->ward_id)
            ->latest('id')
            ->first();

        $patient = $registration->patient;

        return Antrean::create([
            'kodebooking' => $this->deterministicKodebooking($registration->id),
            // Terisi hanya bila kunjungan (realisasi) sudah ada; tujuan yang masih
            // pending (belum diterima ruangan) belum punya Visit sama sekali.
            'visit_id' => $destination->status === VisitDestination::STATUS_ACCEPTED
                ? Visit::query()->where('registration_id', $registration->id)->latest('id')->value('id')
                : null,
            'jenispasien' => 'JKN',
            'nomorkartu' => $guarantor->member_number,
            'nik' => $patient?->nik,
            'nohp' => null,
            'kodepoli' => $kodepoli,
            'namapoli' => $ward?->name,
            'pasienbaru' => false,
            'norm' => $patient?->medical_record_number,
            'tanggalperiksa' => $wardQueue?->queue_date ?? now()->toDateString(),
            'kodedokter' => $kodedokter,
            'namadokter' => $doctor?->name,
            'jampraktek' => null,
            // 3 = Kontrol bila IKUT_IBU/kunjungan lanjutan, selain itu 1 = Rujukan FKTP
            // (default paling umum; tidak ada data rujukan internal vs FKTP di
            // VisitDestination untuk membedakan 2 secara pasti).
            'jeniskunjungan' => $destination->follows_mother ? 3 : 1,
            'nomorreferensi' => $guarantor->reference_letter_number,
            'nomorantrean' => $wardQueue?->queue_number !== null ? (string) $wardQueue->queue_number : null,
            'angkaantrean' => $wardQueue?->queue_number,
            'estimasidilayani' => null,
            'sisakuotajkn' => null,
            'kuotajkn' => null,
            'sisakuotanonjkn' => null,
            'kuotanonjkn' => null,
            'keterangan' => null,
            'status' => 'draft',
            'bpjs_sync_status' => 'pending',
            'created_by' => $destination->created_by,
        ]);
    }

    /**
     * kodebooking deterministik per pendaftaran, dipakai HANYA sebagai penanda
     * idempotensi "tujuan ini sudah punya draf" (bukan format kodebooking asli
     * BPJS, yang harus unik per booking). Draf yang benar-benar dikirim ke BPJS
     * akan mendapat kodebooking final dari WS BPJS sendiri saat sinkronisasi —
     * di luar cakupan service ini karena tidak memanggil BPJS.
     */
    private function deterministicKodebooking(int $registrationId): string
    {
        return 'DRAFT-REG-'.$registrationId;
    }

    /**
     * Cari kodepoli aktif untuk ward tujuan. Ditolak (422) bila ward belum
     * dipetakan — draf tidak boleh terbentuk dengan kodepoli kosong/asal.
     */
    private function resolveWardCode(?Ward $ward): string
    {
        if ($ward === null) {
            throw ValidationException::withMessages([
                'kodepoli' => 'Tujuan pasien ini tidak memiliki ward, kodepoli BPJS tidak dapat ditentukan.',
            ]);
        }

        $mapping = BpjsCodeMapping::query()
            ->where('ward_id', $ward->id)
            ->where('is_active', true)
            ->first();

        if ($mapping === null) {
            throw ValidationException::withMessages([
                'kodepoli' => "Ward \"{$ward->name}\" belum memiliki pemetaan kodepoli BPJS yang aktif. Petakan lewat menu pemetaan kode BPJS terlebih dahulu, atau pasok kodepoli secara manual.",
            ]);
        }

        return $mapping->bpjs_code;
    }

    /**
     * Cari kodedokter aktif untuk dokter tujuan. Ditolak (422) bila dokter
     * belum dipetakan — draf tidak boleh terbentuk dengan kodedokter kosong/
     * asal. Dokter memang boleh null di VisitDestination (belum ditentukan
     * dokter tertentu) — dalam kasus ini kodedokter juga null (BPJS
     * menerima kodedokter kosong untuk beberapa jenis antrean poli umum).
     */
    private function resolveEmployeeCode(?Employee $doctor): ?int
    {
        if ($doctor === null) {
            return null;
        }

        $mapping = BpjsCodeMapping::query()
            ->where('employee_id', $doctor->id)
            ->where('is_active', true)
            ->first();

        if ($mapping === null) {
            throw ValidationException::withMessages([
                'kodedokter' => "Dokter \"{$doctor->name}\" belum memiliki pemetaan kodedokter BPJS yang aktif. Petakan lewat menu pemetaan kode BPJS terlebih dahulu, atau pasok kodedokter secara manual.",
            ]);
        }

        return (int) $mapping->bpjs_code;
    }
}
