<?php

namespace App\Http\Concerns;

use Illuminate\Http\Request;
use Modules\GeneralEmployee\Models\Employee;

/**
 * Isi kolom "pelaku" dari profil pegawai user yang sedang login.
 *
 * Banyak modul klinis punya kolom yang menunjuk `employees` dan MENYATAKAN
 * SIAPA YANG MENGERJAKANNYA — `recorded_by`, `assessed_by`, `author_id`,
 * `performed_by`, `screened_by`. Sebelumnya kolom-kolom itu wajib dikirim
 * klien, artinya petugas harus menghafal id pegawainya sendiri untuk mencatat
 * satu asesmen.
 *
 * Kolom ini BUKAN `employee_id`/`surgeon_id`/`educator_id`, yang menunjuk
 * orang tertentu yang memang harus dipilih petugas (dokter operator, edukator
 * yang ditugaskan). Trait ini hanya untuk "pelakunya adalah saya".
 *
 * Perhatikan: kolom tersebut menunjuk `employees`, BUKAN `users`. Mengisinya
 * dengan id user login akan melanggar foreign key — kekeliruan yang sudah
 * terjadi di beberapa modul pada repo ini.
 */
trait ResolvesActingEmployee
{
    /**
     * Kembalikan id pegawai user login, atau null bila akunnya belum tertaut.
     */
    protected function actingEmployeeId(Request $request): ?int
    {
        $userId = $request->user()?->id;

        if ($userId === null) {
            return null;
        }

        return Employee::query()->where('user_id', $userId)->value('id');
    }

    /**
     * Isi kolom pelaku bila klien tidak mengirimnya.
     *
     * `$required` menentukan perilaku saat user belum punya profil pegawai:
     * kolom NOT NULL harus ditolak dengan pesan yang dapat ditindaklanjuti,
     * karena membiarkannya lolos berarti menabrak constraint database yang
     * muncul di layar sebagai 500 tanpa keterangan.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function fillActingEmployee(Request $request, array $data, string $column, bool $required = true): array
    {
        if (! empty($data[$column])) {
            return $data;
        }

        $employeeId = $this->actingEmployeeId($request);

        abort_if(
            $employeeId === null && $required,
            422,
            'Akun Anda belum tertaut ke data pegawai, sehingga pencatat tidak dapat ditetapkan. Hubungi admin untuk menautkannya.',
        );

        $data[$column] = $employeeId;

        return $data;
    }
}
