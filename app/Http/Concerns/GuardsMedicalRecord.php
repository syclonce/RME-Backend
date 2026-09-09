<?php

namespace App\Http\Concerns;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Http\Request;

/**
 * Gerbang rekam medis untuk controller klinis sederhana.
 *
 * Sebagian besar modul rekam medis (pemeriksaan fisik per-organ, asesmen, riwayat)
 * adalah CRUD yang menempel pada satu kunjungan — tidak punya state machine, tetapi
 * TETAP tidak boleh menulis ke rekam medis yang sudah difinalkan.
 *
 * Sebelum trait ini, 134 modul semacam itu menulis `visit_id` tanpa gerbang apa pun:
 * catatan klinis dapat ditambahkan ke episode yang sudah ditutup, dan itu persis
 * cacat legacy yang dihindari SIMGOS (peta induk Temuan 6 — di SIMGOS2
 * `isValidateBeforeUpdate` tidak pernah di-override, sehingga tidak ada satu pun
 * gerbang tulis berbasis status).
 *
 * Dipisahkan sebagai trait, bukan disalin ke tiap controller, supaya aturannya
 * hidup di satu tempat dan tidak menyimpang antar modul.
 */
trait GuardsMedicalRecord
{
    /**
     * Tolak penulisan bila episode RME kunjungan sudah final.
     *
     * Dilewati bila payload tidak membawa `visit_id` — sebagian modul menerima
     * pencatatan tanpa konteks kunjungan (mis. data yang menempel ke pasien, bukan
     * ke episode), dan memaksa gerbang di situ akan memblokir pencatatan yang sah.
     */
    protected function guardMedicalRecord(Request $request, array $data): void
    {
        if (empty($data['visit_id'])) {
            return;
        }

        app(MedicalRecordGate::class)->assertWritable((int) $data['visit_id'], $request->user());
    }
}
