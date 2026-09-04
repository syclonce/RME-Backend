<?php

namespace Modules\SatuSehat\Tests\Feature;

use App\Events\VisitDischarged;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Tests\TestCase;

class QueueEncounterOnDischargeTest extends TestCase
{
    use RefreshDatabase;

    public function test_discharge_enqueues_encounter_submission(): void
    {
        $visit = Visit::factory()->create([
            'discharged_at' => now(),
            'final_outcome' => 'sembuh',
        ]);

        VisitDischarged::dispatch($visit);

        $this->assertDatabaseHas('satu_sehat_staging_submissions', [
            'resource_type' => 'Encounter',
            'source_type' => Visit::class,
            'source_id' => $visit->id,
            'status' => 'pending',
        ]);
    }

    /** Kunjungan batal tidak pernah terjadi secara klinis — tidak dilaporkan. */
    public function test_cancelled_visit_is_not_enqueued(): void
    {
        $visit = Visit::factory()->create(['status' => 'cancelled', 'discharged_at' => now()]);

        VisitDischarged::dispatch($visit);

        $this->assertDatabaseMissing('satu_sehat_staging_submissions', [
            'source_type' => Visit::class,
            'source_id' => $visit->id,
        ]);
    }

    /**
     * Event domain dapat terpicu berkali-kali; antrean tidak boleh terisi
     * duplikat yang mengirim data sama berulang ke SATUSEHAT.
     */
    public function test_repeated_events_do_not_duplicate_submission(): void
    {
        $visit = Visit::factory()->create(['discharged_at' => now()]);

        VisitDischarged::dispatch($visit);
        VisitDischarged::dispatch($visit);
        VisitDischarged::dispatch($visit);

        $this->assertSame(1, SatuSehatStagingSubmission::query()
            ->where('source_type', Visit::class)
            ->where('source_id', $visit->id)
            ->count());
    }

    /** Payload diperbarui ke keadaan TERBARU, bukan potret event pertama. */
    public function test_requeue_refreshes_payload(): void
    {
        $visit = Visit::factory()->create(['discharged_at' => now(), 'final_outcome' => 'sembuh']);
        VisitDischarged::dispatch($visit);

        $visit->update(['final_outcome' => 'rujuk']);
        VisitDischarged::dispatch($visit->refresh());

        $submission = SatuSehatStagingSubmission::query()
            ->where('source_type', Visit::class)
            ->where('source_id', $visit->id)
            ->firstOrFail();

        $this->assertSame('rujuk', $submission->payload['final_outcome']);
    }
}
