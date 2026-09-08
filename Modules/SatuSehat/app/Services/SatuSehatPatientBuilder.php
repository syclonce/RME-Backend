<?php

namespace Modules\SatuSehat\Services;

use Modules\GeneralPatient\Models\Patient;

/**
 * Susun resource FHIR Patient untuk SATUSEHAT dari model lokal.
 *
 * Dibangun dari nomor rule validator yang dikembalikan sandbox (bukan tebakan):
 * - 10167/10813: salah satu multipleBirthInteger/multipleBirthBoolean WAJIB.
 * - 10621/10622 (+10623/10624): extension administrativeCode province/city/
 *   district/village WAJIB dan harus cocok hierarkinya — diselesaikan dari
 *   tabel wilayah laravolt (province 2-digit, city 4, district 7, village 10),
 *   BUKAN hardcode. Level yang tak terselesaikan dihilangkan (validator akan
 *   menolak — benar, karena memang data yang belum ada, bukan tebakan).
 *
 * Catatan data gap: kembar (selalu false — belum ada field twin), bahasa
 * (default id-ID), marital (dihilangkan bila tak terpetakan).
 */
class SatuSehatPatientBuilder
{
    public function build(Patient $patient): array
    {
        $orgId = config('satusehat.organization_id');

        $payload = [
            'resourceType' => 'Patient',
            'identifier' => array_values(array_filter([
                $patient->nik ? [
                    'system' => 'https://fhir.kemkes.go.id/id/nik',
                    'value' => $patient->nik,
                ] : null,
            ])),
            'active' => (bool) ($patient->is_active ?? true),
            'name' => [
                ['use' => 'official', 'text' => $patient->name],
            ],
            'gender' => $this->gender($patient),
            'birthDate' => $patient->birth_date?->toDateString(),
            // Rule 10167/10813: wajib salah satu. Sumber twin belum ada —
            // default false + dicatat di sini agar mudah ditemukan.
            'multipleBirthBoolean' => false,
            'address' => [$this->address($patient)],
            'communication' => [
                ['language' => ['coding' => [['system' => 'urn:ietf:bcp:47', 'code' => 'id-ID']]], 'preferred' => true],
            ],
            'managingOrganization' => ['reference' => "Organization/{$orgId}"],
        ];

        return array_filter($payload, fn ($v) => $v !== null && $v !== []);
    }

    private function gender(Patient $patient): ?string
    {
        $code = $patient->gender?->code;

        return match ($code) {
            '1' => 'male',
            '2' => 'female',
            default => null,
        };
    }

    /** @return array<string, mixed> */
    private function address(Patient $patient): array
    {
        $codes = $this->administrativeCodes($patient->village_id);

        $extension = [];

        if ($codes !== []) {
            $inner = [];

            foreach (['province', 'city', 'district', 'village'] as $level) {
                if (isset($codes[$level])) {
                    $inner[] = ['url' => $level, 'valueCode' => $codes[$level]];
                }
            }

            if ($inner !== []) {
                $extension[] = [
                    'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode',
                    'extension' => $inner,
                ];
            }
        }

        return array_filter([
            'use' => 'home',
            'line' => $patient->address ? [$patient->address] : null,
            'city' => $patient->birth_place,
            'postalCode' => $patient->postal_code,
            'country' => 'ID',
            'extension' => $extension !== [] ? $extension : null,
        ], fn ($v) => $v !== null && $v !== []);
    }

    /**
     * Telusuri village → district → city → province, kembalikan kode tiap
     * level yang ketemu. Sepenuhnya dari DB (seed laravolt), tanpa hardcode.
     *
     * @return array{province?: string, city?: string, district?: string, village?: string}
     */
    public function administrativeCodes(?int $villageId): array
    {
        if ($villageId === null) {
            return [];
        }

        $village = \Illuminate\Support\Facades\DB::table('indonesia_villages')->where('id', $villageId)->first();

        if ($village === null) {
            return [];
        }

        $codes = ['village' => $village->code];

        $district = \Illuminate\Support\Facades\DB::table('indonesia_districts')->where('code', $village->district_code)->first();

        if ($district === null) {
            return $codes;
        }

        $codes['district'] = $district->code;

        $city = \Illuminate\Support\Facades\DB::table('indonesia_cities')->where('code', $district->city_code)->first();

        if ($city === null) {
            return $codes;
        }

        $codes['city'] = $city->code;

        $province = \Illuminate\Support\Facades\DB::table('indonesia_provinces')->where('code', $city->province_code)->first();

        if ($province !== null) {
            $codes['province'] = $province->code;
        }

        return $codes;
    }
}
