<?php

namespace Modules\MedicalRecordEpisode\Tests\Feature;

use App\Observers\MedicalRecordMutationGuard;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\GeneralWard\Models\Ward;
use Modules\MedicalRecordAdmissionMedicationReconciliationItem\Models\AdmissionMedicationReconciliationItem;
use Modules\MedicalRecordAllergy\Models\Allergy;
use Modules\MedicalRecordAnamnesis\Models\Anamnesis;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\MedicalRecordBloodTransfusionObservation\Models\BloodTransfusionObservation;
use Modules\MedicalRecordEpisode\Models\MedicalRecordEpisode;
use Modules\PendaftaranVisit\Models\Visit;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

/**
 * Rollout guard Fase 3 legacy: penegakan terpusat (observer) untuk ±162 modul
 * MR — update/delete pada episode final ditolak dari jalur mana pun, bukan
 * hanya lewat controller yang sempat dipasangi guard.
 */
class MedicalRecordMutationGuardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
    }

    private function finalizeVisit(int $visitId): void
    {
        MedicalRecordEpisode::create([
            'visit_id' => $visitId,
            'status' => MedicalRecordEpisode::STATUS_FINALIZED,
        ]);
    }

    public function test_update_langsung_ditolak_saat_final(): void
    {
        $record = Anamnesis::factory()->create();
        $this->finalizeVisit($record->visit_id);

        $this->expectException(HttpException::class);
        $record->update(['present_illness_history' => 'Diubah setelah final']);
    }

    public function test_delete_langsung_ditolak_saat_final_dan_baris_utuh(): void
    {
        $record = Anamnesis::factory()->create();
        $this->finalizeVisit($record->visit_id);

        try {
            $record->delete();
            $this->fail('Penghapusan catatan final harus ditolak.');
        } catch (HttpException $e) {
            $this->assertSame(422, $e->getStatusCode());
        }

        $this->assertDatabaseHas('anamneses', ['id' => $record->id]);
    }

    public function test_tulis_dibolehkan_saat_open_amending_tanpa_episode(): void
    {
        $open = Anamnesis::factory()->create();
        MedicalRecordEpisode::create(['visit_id' => $open->visit_id, 'status' => MedicalRecordEpisode::STATUS_OPEN]);
        $open->update(['present_illness_history' => 'Koreksi saat open']);
        $this->assertSame('Koreksi saat open', $open->refresh()->present_illness_history);

        $amending = Anamnesis::factory()->create();
        MedicalRecordEpisode::create(['visit_id' => $amending->visit_id, 'status' => MedicalRecordEpisode::STATUS_AMENDING]);
        $amending->update(['present_illness_history' => 'Koreksi via amendment']);
        $this->assertSame('Koreksi via amendment', $amending->refresh()->present_illness_history);

        $bare = Anamnesis::factory()->create();
        $bare->update(['present_illness_history' => 'Tanpa episode']);
        $this->assertSame('Tanpa episode', $bare->refresh()->present_illness_history);
    }

    public function test_anak_mengikuti_episode_induknya(): void
    {
        $item = AdmissionMedicationReconciliationItem::factory()->create();
        $visitId = $item->reconciliation->visit_id;
        $this->assertNotNull($visitId);
        $this->finalizeVisit($visitId);

        try {
            $item->update(['dose' => '999mg']);
            $this->fail('Ubah item rekonsiliasi pada episode final harus ditolak.');
        } catch (HttpException $e) {
            $this->assertSame(422, $e->getStatusCode());
        }
    }

    public function test_anak_tanpa_relasi_bertipe_mengikuti_fk_induknya(): void
    {
        $transfusion = BloodTransfusion::factory()->create();
        $observation = BloodTransfusionObservation::factory()->create([
            'blood_transfusion_id' => $transfusion->id,
        ]);
        $this->finalizeVisit($transfusion->visit_id);

        // resolveVisitId menemukan visit lewat FK, bukan relasi bertipe.
        $this->assertSame(
            $transfusion->visit_id,
            MedicalRecordMutationGuard::resolveVisitId($observation)
        );

        try {
            $observation->delete();
            $this->fail('Hapus observasi pada episode final harus ditolak.');
        } catch (HttpException $e) {
            $this->assertSame(422, $e->getStatusCode());
        }
    }

    public function test_model_non_episode_tidak_tersentuh(): void
    {
        // Allergy = registri longitudinal pasien (tanpa visit_id): boleh diubah
        // kapan pun — ini keputusan eksplisit, bukan lubang.
        $allergy = Allergy::factory()->create();
        $allergy->update(['allergen' => 'Kacang']);
        $this->assertSame('Kacang', $allergy->refresh()->allergen);

        // Non-MR: namespace lain tidak pernah digerbang.
        $ward = Ward::factory()->create();
        $ward->update(['name' => 'Melati Baru']);
        $this->assertSame('Melati Baru', $ward->refresh()->name);
    }

    public function test_cakupan_semua_model_visit_terlindungi_atau_dikecualikan_eksplisit(): void
    {
        $uncovered = [];
        $dir = base_path('Modules');

        foreach (glob($dir.'/MedicalRecord*/app/Models/*.php') as $file) {
            $class = $this->classFromFile($file);

            if ($class === null || ! class_exists($class)) {
                continue;
            }

            $model = new $class;
            $fillable = $model->getFillable();

            if (in_array('visit_id', $fillable, true)) {
                continue; // jalur langsung — otomatis terlindungi.
            }

            if (isset(MedicalRecordMutationGuard::PARENT_MAP[$class])) {
                continue; // jalur anak — terlindungi via induk.
            }

            if (isset(MedicalRecordMutationGuard::EXCLUDED[$class])) {
                continue; // dikecualikan eksplisit + alasan.
            }

            $uncovered[] = $class;
        }

        $this->assertSame(
            [],
            $uncovered,
            'Model MR tanpa perlindungan guard: '.implode(', ', $uncovered)
            .'. Tambahkan ke PARENT_MAP atau EXCLUDED di MedicalRecordMutationGuard.'
        );
    }

    private function classFromFile(string $file): ?string
    {
        $src = file_get_contents($file);

        if (! preg_match('/^namespace\s+(.+?);/m', $src, $ns)) {
            return null;
        }

        if (! preg_match('/^class\s+(\w+)/m', $src, $cls)) {
            return null;
        }

        return $ns[1].'\\'.$cls[1];
    }
}
