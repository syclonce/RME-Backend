<?php

namespace Modules\EKlaim\Services;

use Illuminate\Validation\ValidationException;
use Modules\EKlaim\Models\EklaimCall;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;

/**
 * Orkestrasi pengajuan klaim INA-CBG — alur 7 langkah legacy.
 *
 * SIMGOS2 menjalankan urutan ini di `INACBGService/V5/Service.php::grouper()`
 * (peta induk Temuan 11):
 *
 *   1. generateNomorKlaim   4. updateDataKlaim   7. sendClaim
 *   2. klaimBaru (new_claim) 5. grouping
 *   3. updateDataPasien      6. finalKlaim
 *
 * `EklaimService` SIMGOS sudah menyediakan setiap langkahnya sebagai method
 * tersendiri, tetapi **tidak ada yang mengurutkannya** — klien harus tahu urutannya
 * sendiri. Kelas ini yang mengurutkannya.
 *
 * ## Celah legacy yang DIPERBAIKI
 *
 * Legacy membungkam kegagalan pengiriman: pada `V5/Service.php:1435-1439`, cabang
 * gagal hanya menyetel `kirim = 0` sementara kode dan pesan errornya
 * **dikomentari**. Klaim gagal terkirim tanpa petugas tahu alasannya — langsung
 * memotong pendapatan faskes.
 *
 * Di sini setiap langkah diperiksa hasilnya, dan langkah pertama yang gagal
 * MENGHENTIKAN rangkaian dengan pesan yang menyebut langkah mana dan kenapa.
 * Tidak ada kegagalan yang lewat diam-diam.
 *
 * Legacy juga menjalankan seluruh rangkaian lalu menulis hasilnya sekali di akhir;
 * bila langkah tengah gagal, langkah sesudahnya tetap dijalankan di atas data yang
 * tidak sah. Di sini rangkaian berhenti pada kegagalan pertama.
 */
class ClaimSubmissionOrchestrator
{
    /** Urutan langkah dan method `EklaimService` yang menjalankannya. */
    private const STEPS = [
        'new_claim' => 'newClaim',
        'set_claim_data' => 'setClaimData',
        'grouper' => 'grouper',
        'claim_final' => 'claimFinal',
        'send_claim' => 'sendClaim',
    ];

    public function __construct(protected EklaimService $eklaim) {}

    /**
     * Jalankan rangkaian pengajuan untuk satu klaim internal.
     *
     * @return array<string, EklaimCall> hasil tiap langkah, terurut
     *
     * @throws ValidationException bila salah satu langkah gagal
     */
    public function submit(ClaimInvoice $claim, array $payload): array
    {
        // Hanya klaim draf yang boleh diajukan. Klaim yang sudah submitted/verified
        // diajukan ulang akan menghasilkan klaim ganda di sisi Kemkes — dan itu
        // ditolak saat verifikasi, setelah berminggu-minggu.
        if ($claim->status !== 'draft') {
            throw ValidationException::withMessages([
                'status' => "Klaim berstatus {$claim->status} tidak dapat diajukan ulang.",
            ]);
        }

        $results = [];

        foreach (self::STEPS as $label => $method) {
            /** @var EklaimCall $call */
            $call = $this->eklaim->{$method}($payload);
            $results[$label] = $call;

            if ($call->status !== 'sent') {
                // Kegagalan DILAPORKAN, bukan dibungkam. Klaim tetap `draft`
                // sehingga dapat diajukan ulang setelah penyebabnya diperbaiki —
                // berbeda dari legacy yang menandai kirim=0 tanpa jalan kembali.
                throw ValidationException::withMessages([
                    'eklaim' => "Pengajuan klaim gagal pada langkah '{$label}': "
                        .($call->error_message ?? 'penyebab tidak dilaporkan server E-Klaim.'),
                ]);
            }
        }

        $claim->update([
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        return $results;
    }
}
