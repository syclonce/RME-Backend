<?php

namespace Modules\PendaftaranConsultation\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralMedicalDepartmentWardAssignment\Models\MedicalDepartmentWardAssignment;
use Modules\PendaftaranVisit\Services\VisitService;
use Modules\PendaftaranConsultation\Models\Consultation;
use Modules\PendaftaranConsultationAnswer\Models\ConsultationAnswer;

/**
 * Alur konsul antar unit: kirim -> jawab.
 *
 * Legacy memisahkan Pengiriman (`/pendaftaran/konsul`) dari Feedback
 * (`/pendaftaran/jawabankonsul`) sebagai dua menu berbeda dengan privilege
 * berbeda (`110301` mengirim, `110401` menjawab). Yang membuat pemisahan itu
 * bekerja adalah `konsul.STATUS` — tanpanya unit tujuan tidak punya daftar
 * kerja, dan konsul terkirim tidak dapat dibedakan dari yang sudah dijawab.
 *
 * Jawaban disimpan sebagai baris tersendiri (`consultation_answers`) sehingga
 * satu konsul dapat menerima lebih dari satu jawaban; `status` dan `answered_at`
 * pada konsul adalah turunan, dipakai agar daftar "menunggu jawaban" tidak perlu
 * join.
 */
class ConsultationService
{
    public function __construct(
        protected MedicalRecordGate $medicalRecordGate,
        protected VisitService $visitService,
    ) {}

    public function request(array $data, User $user): Consultation
    {
        // Konsul menambah catatan pada rekam medis kunjungan, jadi tunduk pada
        // gerbang yang sama dengan diagnosis dan resep.
        $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);

        return Consultation::create([
            ...$data,
            'requested_at' => $data['requested_at'] ?? now(),
            'requested_by' => $user->id,
            'status' => Consultation::STATUS_PENDING,
        ]);
    }

    /**
     * Jawab konsul. Menutup status dalam satu transaksi dengan penyimpanan
     * jawaban supaya tidak ada konsul berstatus terjawab tanpa isi jawaban.
     */
    public function answer(Consultation $consultation, string $answer, User $user): ConsultationAnswer
    {
        abort_if(
            $consultation->status === Consultation::STATUS_CANCELLED,
            422,
            'Konsul sudah dibatalkan dan tidak dapat dijawab.',
        );

        // Kolom `answered_by` menunjuk tabel `employees`, bukan `users` — yang
        // menjawab konsul adalah dokter, dan dokter adalah pegawai. Menulis id
        // user langsung akan melanggar FK (konvensi sama dipakai
        // LabAnalyzerOrderService::verify dan AuditQualityIndicator).
        $employeeId = Employee::query()->where('user_id', $user->id)->value('id');

        abort_if(
            $employeeId === null,
            422,
            'User login belum terhubung ke profil pegawai, tidak dapat menjawab konsul.',
        );

        return DB::transaction(function () use ($consultation, $answer, $employeeId, $user) {
            $record = ConsultationAnswer::create([
                'consultation_id' => $consultation->id,
                'answered_by' => $employeeId,
                'answered_at' => now(),
                'answer' => $answer,
            ]);

            // Jawaban susulan diperbolehkan, tetapi `answered_at` tetap menunjuk
            // jawaban PERTAMA — itu yang dipakai mengukur waktu tanggap unit.
            $isFirstAnswer = $consultation->answered_at === null;

            $consultation->update([
                'status' => Consultation::STATUS_ANSWERED,
                'answered_at' => $consultation->answered_at ?? now(),
            ]);

            // Pola legacy: konsul yang DITERIMA melahirkan kunjungan baru di unit
            // tujuan, dengan `kunjungan.REF` menunjuk balik ke konsulnya
            // (KunjunganResource::create b.56-70, prefix 10 = konsul). Itulah yang
            // membuat pelayanan dan tindakan unit konsulen tercatat sebagai
            // kunjungannya sendiri, bukan menumpang kunjungan unit pengirim.
            //
            // Hanya pada jawaban PERTAMA: jawaban susulan adalah tambahan pada
            // pelayanan yang sama, bukan pelayanan baru.
            if ($isFirstAnswer) {
                $this->createConsultVisit($consultation, $user);
            }

            return $record;
        });
    }

    public function cancel(Consultation $consultation): Consultation
    {
        abort_if(
            $consultation->status === Consultation::STATUS_ANSWERED,
            422,
            'Konsul sudah dijawab dan tidak dapat dibatalkan.',
        );

        $consultation->update(['status' => Consultation::STATUS_CANCELLED]);

        return $consultation->refresh();
    }

    /**
     * Terbitkan kunjungan unit konsulen.
     *
     * Dilewati diam-diam bila unit tujuan tidak punya ruangan terpetakan — konsul
     * tetap terjawab dan tercatat; yang hilang hanya kunjungan turunannya. Menolak
     * jawaban karena pemetaan ruangan belum lengkap akan menghalangi pelayanan
     * klinis demi kerapian data.
     */
    protected function createConsultVisit(Consultation $consultation, User $user): void
    {
        // Ruangan utama unit didahulukan: satu SMF bisa memegang beberapa ruangan,
        // dan konsul masuk ke ruangan pokoknya, bukan sembarang yang terdaftar.
        $wardId = MedicalDepartmentWardAssignment::query()
            ->where('medical_department_id', $consultation->consulted_department_id)
            ->orderByDesc('is_primary')
            ->value('ward_id');

        if ($wardId === null) {
            return;
        }

        $this->visitService->admit([
            'registration_id' => $consultation->visit?->registration_id,
            'ward_id' => $wardId,
            'admitted_at' => now(),
            'origin_type' => Consultation::class,
            'origin_id' => $consultation->id,
        ], $user);
    }
}
