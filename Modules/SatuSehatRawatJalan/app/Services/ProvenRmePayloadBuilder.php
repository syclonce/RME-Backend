<?php

namespace Modules\SatuSehatRawatJalan\Services;

/**
 * Payload FHIR RME Rawat Jalan yang TERBUKTI lolos validator sandbox
 * (sesi live 2026-09-07, Encounter SIMGOS-TEST-001). Tiap sistem/kode di bawah
 * adalah hasil iterasi terhadap nomor rule validator — bukan salinan contoh
 * yang belum teruji (contoh: route v3-RouteOfAdministration DITOLAK 10038,
 * medication-type https DITOLAK 10031, authorising (s) DITOLAK struktur).
 *
 * Aturan umum yang terbukti: ejaan STU3 (context, authorizingPrescription
 * dengan z), identifier opsional kecuali dinyatakan wajib validator,
 * waktu UTC+07:00 eksplisit.
 */
class ProvenRmePayloadBuilder
{
    public function __construct(private readonly string $orgId)
    {
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function medication(array $d): array
    {
        return [
            'resourceType' => 'Medication',
            'identifier' => [[
                'system' => "http://sys-ids.kemkes.go.id/medication/{$this->orgId}",
                'use' => 'official',
                'value' => $d['local_id'],
            ]],
            'code' => ['coding' => [[
                'system' => 'http://sys-ids.kemkes.go.id/kfa',
                'code' => $d['kfa_code'],
                'display' => $d['kfa_display'] ?? null,
            ]]],
            'status' => 'active',
            'form' => ['coding' => [[
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/medication-form',
                'code' => $d['form_code'],
                'display' => $d['form_display'] ?? null,
            ]]],
            'extension' => [[
                'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/MedicationType',
                'valueCodeableConcept' => ['coding' => [[
                    // http, BUKAN https — terbukti 10031.
                    'system' => 'http://terminology.kemkes.go.id/CodeSystem/medication-type',
                    'code' => 'NC',
                    'display' => 'Non-compound',
                ]]],
            ]],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function medicationDispense(array $d): array
    {
        return [
            'resourceType' => 'MedicationDispense',
            'identifier' => [[
                'system' => "http://sys-ids.kemkes.go.id/prescription/{$this->orgId}",
                'use' => 'official',
                'value' => $d['local_id'],
            ]],
            'status' => 'completed',
            'medicationReference' => ['reference' => "Medication/{$d['medication_id']}"],
            'subject' => ['reference' => "Patient/{$d['patient_id']}"],
            // STU3: context (bukan encounter) + authorizingPrescription (z).
            'context' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'performer' => [['actor' => ['reference' => "Practitioner/{$d['practitioner_id']}"]]],
            'location' => ['reference' => "Location/{$d['location_id']}"],
            'authorizingPrescription' => [['reference' => "MedicationRequest/{$d['request_id']}"]],
            'quantity' => [
                'value' => $d['quantity_value'],
                'unit' => $d['quantity_unit'],
                'system' => 'http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm',
                'code' => $d['quantity_code'],
            ],
            'whenHandedOver' => $d['handed_over_at'],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function procedure(array $d): array
    {
        return [
            'resourceType' => 'Procedure',
            'status' => 'completed',
            'category' => ['coding' => [[
                'system' => 'http://snomed.info/sct',
                'code' => '103693007',
                'display' => 'Diagnostic procedure',
            ]]],
            'code' => ['coding' => [[
                'system' => 'http://hl7.org/fhir/sid/icd-9-cm',
                'code' => $d['icd9_code'],
                'display' => $d['icd9_display'] ?? null,
            ]]],
            'subject' => ['reference' => "Patient/{$d['patient_id']}"],
            'encounter' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'performedDateTime' => $d['performed_at'],
            'performer' => [['actor' => ['reference' => "Practitioner/{$d['practitioner_id']}"]]],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function noKnownAllergy(array $d): array
    {
        return [
            'resourceType' => 'AllergyIntolerance',
            'clinicalStatus' => ['coding' => [[
                'system' => 'http://terminology.hl7.org/CodeSystem/allergyintolerance-clinical',
                'code' => 'active',
            ]]],
            'verificationStatus' => ['coding' => [[
                'system' => 'http://terminology.hl7.org/CodeSystem/allergyintolerance-verification',
                'code' => 'confirmed',
            ]]],
            'type' => 'allergy',
            'category' => ['medication'],
            'code' => ['coding' => [[
                'system' => 'http://snomed.info/sct',
                'code' => '716186003',
                'display' => 'No known allergy',
            ]]],
            'patient' => ['reference' => "Patient/{$d['patient_id']}"],
            'encounter' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'recordedDate' => $d['recorded_at'],
            'recorder' => ['reference' => "Practitioner/{$d['practitioner_id']}"],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function followUpServiceRequest(array $d): array
    {
        return [
            'resourceType' => 'ServiceRequest',
            'identifier' => [[
                'system' => "http://sys-ids.kemkes.go.id/servicerequest/{$this->orgId}",
                'use' => 'official',
                'value' => $d['local_id'],
            ]],
            'status' => 'active',
            'intent' => 'order',
            // SNOMED Follow-up visit — sistem service-request-type DITOLAK 10060.
            'code' => ['coding' => [[
                'system' => 'http://snomed.info/sct',
                'code' => '185389009',
                'display' => 'Follow-up visit',
            ]]],
            'subject' => ['reference' => "Patient/{$d['patient_id']}"],
            'encounter' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'occurrenceDateTime' => $d['occurrence_at'],
            'requester' => ['reference' => "Practitioner/{$d['practitioner_id']}"],
            'performer' => [['reference' => "Practitioner/{$d['practitioner_id']}"]],
            'patientInstruction' => $d['instruction'] ?? null,
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function clinicalImpression(array $d): array
    {
        return [
            'resourceType' => 'ClinicalImpression',
            'identifier' => [[
                'system' => "http://sys-ids.kemkes.go.id/clinicalimpression/{$this->orgId}",
                'use' => 'official',
                'value' => $d['local_id'],
            ]],
            'status' => 'completed',
            'description' => $d['description'],
            'subject' => ['reference' => "Patient/{$d['patient_id']}"],
            'encounter' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'effectiveDateTime' => $d['effective_at'],
            'date' => $d['effective_at'],
            'assessor' => ['reference' => "Practitioner/{$d['practitioner_id']}"],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function carePlan(array $d): array
    {
        return [
            'resourceType' => 'CarePlan',
            'identifier' => [[
                'system' => "http://sys-ids.kemkes.go.id/careplan/{$this->orgId}",
                'use' => 'official',
                'value' => $d['local_id'],
            ]],
            'status' => 'active',
            'intent' => 'order',
            // SNOMED Discharge care plan — sistem care-plan-category DITOLAK 10330.
            'category' => [['coding' => [[
                'system' => 'http://snomed.info/sct',
                'code' => '736372004',
                'display' => 'Discharge care plan',
            ]]]],
            'title' => $d['title'],
            'description' => $d['description'],
            'subject' => ['reference' => "Patient/{$d['patient_id']}"],
            'encounter' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'period' => ['start' => $d['start_at']],
            'author' => ['reference' => "Practitioner/{$d['practitioner_id']}"],
            'activity' => [['detail' => [
                'status' => 'in-progress',
                'description' => $d['description'],
            ]]],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function questionnaireResponse(array $d): array
    {
        return [
            'resourceType' => 'QuestionnaireResponse',
            'status' => 'completed',
            'subject' => ['reference' => "Patient/{$d['patient_id']}"],
            'encounter' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'authored' => $d['authored_at'],
            'author' => ['reference' => "Practitioner/{$d['practitioner_id']}"],
            // source = PENGISI (Practitioner), bukan MedicationRequest.
            'source' => ['reference' => "Practitioner/{$d['practitioner_id']}"],
            'item' => [[
                'linkId' => '1',
                'text' => $d['question'],
                'answer' => [['valueString' => $d['answer']]],
            ]],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function diagnosticReport(array $d): array
    {
        return [
            'resourceType' => 'DiagnosticReport',
            'status' => 'final',
            'category' => [['coding' => [[
                'system' => 'http://terminology.hl7.org/CodeSystem/v2-0074',
                'code' => 'LAB',
                'display' => 'Laboratory',
            ]]]],
            'code' => ['coding' => [[
                'system' => 'http://loinc.org',
                'code' => $d['loinc_code'],
                'display' => $d['loinc_display'] ?? null,
            ]]],
            'subject' => ['reference' => "Patient/{$d['patient_id']}"],
            'encounter' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'effectiveDateTime' => $d['effective_at'],
            'issued' => $d['effective_at'],
            'performer' => [['reference' => "Practitioner/{$d['practitioner_id']}"]],
            'specimen' => [['reference' => "Specimen/{$d['specimen_id']}"]],
            'result' => [['reference' => "Observation/{$d['observation_id']}"]],
            // basedOn WAJIB (10387); identifier opsional.
            'basedOn' => [['reference' => "ServiceRequest/{$d['service_request_id']}"]],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function immunization(array $d): array
    {
        return [
            'resourceType' => 'Immunization',
            'identifier' => [[
                'system' => "http://sys-ids.kemkes.go.id/immunization/{$this->orgId}",
                'use' => 'official',
                'value' => $d['local_id'],
            ]],
            'status' => 'completed',
            'vaccineCode' => ['coding' => [[
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/immunization-vaccine',
                'code' => $d['vaccine_code'],
                'display' => $d['vaccine_display'] ?? null,
            ]]],
            'patient' => ['reference' => "Patient/{$d['patient_id']}"],
            'encounter' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'occurrenceDateTime' => $d['occurred_at'],
            'recorded' => $d['occurred_at'],
            'primarySource' => true,
            'location' => ['reference' => "Location/{$d['location_id']}"],
            'manufacturer' => ['reference' => 'Organization/' . $this->orgId],
            'lotNumber' => $d['lot_number'],
            'expirationDate' => $d['expiration_date'],
            'site' => ['coding' => [[
                'system' => 'http://terminology.hl7.org/CodeSystem/v3-ActSite',
                'code' => $d['site_code'],
                'display' => $d['site_display'] ?? null,
            ]]],
            'route' => ['coding' => [[
                'system' => 'http://terminology.hl7.org/CodeSystem/v3-RouteOfAdministration',
                'code' => $d['route_code'],
                'display' => $d['route_display'] ?? null,
            ]]],
            'doseQuantity' => [
                'value' => $d['dose_value'],
                'unit' => $d['dose_unit'],
                'system' => 'http://unitsofmeasure.org',
                'code' => $d['dose_code'],
            ],
            'performer' => [['actor' => ['reference' => "Practitioner/{$d['practitioner_id']}"]]],
            'protocolApplied' => [['doseNumberPositiveInt' => $d['dose_number'] ?? 1]],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function imagingStudy(array $d): array
    {
        return [
            'resourceType' => 'ImagingStudy',
            'identifier' => [[
                'system' => "http://sys-ids.kemkes.go.id/imagingstudy/{$this->orgId}",
                'use' => 'official',
                'value' => $d['local_id'],
            ]],
            'status' => 'available',
            'modality' => [[
                'system' => 'http://dicom.nema.org/resources/ontology/DCM',
                'code' => $d['modality_code'],
                'display' => $d['modality_display'] ?? null,
            ]],
            'subject' => ['reference' => "Patient/{$d['patient_id']}"],
            'encounter' => ['reference' => "Encounter/{$d['encounter_id']}"],
            'started' => $d['started_at'],
            'basedOn' => [['reference' => "ServiceRequest/{$d['service_request_id']}"]],
            'referrer' => ['reference' => "Practitioner/{$d['practitioner_id']}"],
            'interpreter' => [['reference' => "Practitioner/{$d['practitioner_id']}"]],
            // TANPA endpoint NIDR fiktif — validator menolak referensi palsu.
            // Citra DICOM asli lewat DICOM router di produksi.
            'series' => [[
                'uid' => $d['series_uid'],
                'number' => 1,
                'modality' => [
                    'system' => 'http://dicom.nema.org/resources/ontology/DCM',
                    'code' => $d['modality_code'],
                    'display' => $d['modality_display'] ?? null,
                ],
                'description' => $d['description'] ?? null,
                'numberOfInstances' => 1,
                'bodySite' => [
                    'system' => 'http://snomed.info/sct',
                    'code' => $d['bodysite_code'],
                    'display' => $d['bodysite_display'] ?? null,
                ],
                'instance' => [[
                    'uid' => $d['instance_uid'],
                    'sopClass' => [
                        'system' => 'urn:ietf:rfc:3986',
                        'code' => 'urn:oid:1.2.840.10008.5.1.4.1.1.1',
                    ],
                    'number' => 1,
                ]],
            ]],
        ];
    }

    /** @param array<string, mixed> $d @return array<string, mixed> */
    public function episodeOfCareTb(array $d): array
    {
        return [
            'resourceType' => 'EpisodeOfCare',
            'identifier' => [[
                'system' => "http://sys-ids.kemkes.go.id/episode-of-care/{$this->orgId}",
                'use' => 'official',
                'value' => $d['local_id'],
            ]],
            // Hanya 'active' yang bisa dibuat; satu pasien = satu episode
            // aktif per tipe (10109/10110).
            'status' => 'active',
            'statusHistory' => [[
                'status' => 'active',
                // WAJIB dateTime; tanggal vs jam server: lampau, ≥ 2014-06-03.
                'period' => ['start' => $d['start_at']],
            ]],
            // http, BUKAN https (contoh docs salah di sini).
            'type' => [['coding' => [[
                'system' => 'http://terminology.kemkes.go.id/CodeSystem/episodeofcare-type',
                'code' => 'TB-SO',
                'display' => 'Tuberkulosis Sensitif Obat',
            ]]]],
            'diagnosis' => [[
                'condition' => ['reference' => "Condition/{$d['condition_id']}"],
                'role' => ['coding' => [[
                    'system' => 'http://terminology.hl7.org/CodeSystem/diagnosis-role',
                    'code' => 'AD',
                    'display' => 'Admission diagnosis',
                ]]],
                'rank' => 1,
            ]],
            'patient' => ['reference' => "Patient/{$d['patient_id']}"],
            'managingOrganization' => ['reference' => 'Organization/' . $this->orgId],
            'period' => ['start' => $d['start_at']],
        ];
    }
}
