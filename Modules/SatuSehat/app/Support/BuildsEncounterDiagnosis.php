<?php

namespace Modules\SatuSehat\Support;

/**
 * Elemen diagnosis Encounter (rule validator 10457): rank 1 = utama,
 * merujuk Condition yang sudah terbit. Opsional — Encounter arrived dibuat
 * tanpa diagnosis; ditambahkan saat finalisasi via PUT setelah Condition ada.
 */
trait BuildsEncounterDiagnosis
{
    /** @param array<string, mixed> $data @return array<string, mixed> */
    protected function encounterDiagnosis(array $data): array
    {
        if (empty($data['diagnosis_condition_id'])) {
            return [];
        }

        return [
            'diagnosis' => [
                [
                    'condition' => [
                        'reference' => "Condition/{$data['diagnosis_condition_id']}",
                    ],
                    'use' => [
                        'coding' => [
                            [
                                'system' => 'http://terminology.hl7.org/CodeSystem/diagnosis-role',
                                'code' => 'DD',
                                'display' => 'Discharge diagnosis',
                            ],
                        ],
                    ],
                    'rank' => 1,
                ],
            ],
        ];
    }
}
