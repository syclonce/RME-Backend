<?php

namespace Modules\SatuSehatRawatJalan\Tests\Unit;

use Modules\SatuSehatRawatJalan\Services\ProvenRmePayloadBuilder;
use Tests\TestCase;

/**
 * Bentuk payload = hasil iterasi live sandbox (bukan contoh belum teruji).
 * Test ini mengunci sistem/kode/ejaan yang terbukti lolos agar regresi
 * tertangkap di CI, bukan di validator live.
 */
class ProvenRmePayloadBuilderTest extends TestCase
{
    private ProvenRmePayloadBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new ProvenRmePayloadBuilder('057a9498-6e93-47ba-abe5-9c06aa895a28');
    }

    public function test_medication_memakai_sistem_terbukti(): void
    {
        $payload = $this->builder->medication([
            'local_id' => 'OBAT-1', 'kfa_code' => '93001019',
            'form_code' => 'BS023',
        ]);

        $this->assertSame(
            'http://sys-ids.kemkes.go.id/kfa',
            $payload['code']['coding'][0]['system']
        );
        $this->assertSame(
            'http://terminology.kemkes.go.id/CodeSystem/medication-form',
            $payload['form']['coding'][0]['system']
        );
        $this->assertSame(
            'http://terminology.kemkes.go.id/CodeSystem/medication-type',
            $payload['extension'][0]['valueCodeableConcept']['coding'][0]['system']
        );
    }

    public function test_dispense_memakai_ejaan_stu3(): void
    {
        $payload = $this->builder->medicationDispense([
            'local_id' => 'D-1', 'medication_id' => 'M1', 'patient_id' => 'P1',
            'encounter_id' => 'E1', 'practitioner_id' => 'D1', 'location_id' => 'L1',
            'request_id' => 'MR1', 'quantity_value' => 30, 'quantity_unit' => 'Tablet',
            'quantity_code' => 'TAB', 'handed_over_at' => '2026-09-07T08:40:00+07:00',
        ]);

        $this->assertArrayHasKey('context', $payload);
        $this->assertArrayHasKey('authorizingPrescription', $payload);
        $this->assertArrayNotHasKey('authorisingPrescription', $payload);
        $this->assertArrayNotHasKey('encounter', $payload);
    }

    public function test_questionnaire_source_adalah_pengisi(): void
    {
        $payload = $this->builder->questionnaireResponse([
            'patient_id' => 'P1', 'encounter_id' => 'E1',
            'authored_at' => '2026-09-07T08:45:00+07:00', 'practitioner_id' => 'D1',
            'question' => 'Tepat indikasi?', 'answer' => 'Ya',
        ]);

        $this->assertSame('Practitioner/D1', $payload['source']['reference']);
    }

    public function test_diagnostic_report_membawa_basedon(): void
    {
        $payload = $this->builder->diagnosticReport([
            'loinc_code' => '58410-2', 'patient_id' => 'P1', 'encounter_id' => 'E1',
            'effective_at' => '2026-09-07T08:30:00+07:00', 'practitioner_id' => 'D1',
            'specimen_id' => 'S1', 'observation_id' => 'O1', 'service_request_id' => 'SR1',
        ]);

        $this->assertSame('ServiceRequest/SR1', $payload['basedOn'][0]['reference']);
    }

    public function test_careplan_dan_service_request_memakai_snomed(): void
    {
        $carePlan = $this->builder->carePlan([
            'local_id' => 'CP-1', 'title' => 'T', 'description' => 'D',
            'patient_id' => 'P1', 'encounter_id' => 'E1', 'start_at' => '2026-09-07T08:00:00+07:00',
            'practitioner_id' => 'D1',
        ]);
        $serviceRequest = $this->builder->followUpServiceRequest([
            'local_id' => 'SR-1', 'patient_id' => 'P1', 'encounter_id' => 'E1',
            'occurrence_at' => '2026-09-14T08:00:00+07:00', 'practitioner_id' => 'D1',
        ]);

        $this->assertSame('http://snomed.info/sct', $carePlan['category'][0]['coding'][0]['system']);
        $this->assertSame('http://snomed.info/sct', $serviceRequest['code']['coding'][0]['system']);
    }
}
