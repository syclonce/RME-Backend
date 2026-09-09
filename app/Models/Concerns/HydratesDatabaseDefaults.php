<?php

namespace App\Models\Concerns;

/**
 * Mengisi kembali atribut yang nilainya ditetapkan database, bukan PHP.
 *
 * Masalahnya: `Model::create([...])` mengembalikan model berisi PERSIS apa yang
 * dikirim. Kolom dengan `->default(...)` di migrasi tidak ikut terisi, jadi
 * responsnya memuat null untuk nilai yang di database sebenarnya sudah ada:
 *
 *     POST /api/v1/visits  ->  "status": null      (di DB: 'active')
 *     POST /api/v1/registrations -> "status": null (di DB: 'active')
 *
 * Ditemukan lewat pemanggilan HTTP sungguhan ke server dev. Tes tidak
 * menangkapnya karena kebanyakan memeriksa isi database (assertDatabaseHas),
 * bukan badan respons -- dan database memang benar sejak awal.
 *
 * Akibatnya nyata di klien: layar yang menyaring "kunjungan aktif" tidak dapat
 * membedakan kunjungan baru dari yang batal, karena keduanya datang null.
 *
 * Sebagian besar controller sudah menambal ini sendiri dengan `->refresh()`
 * (195 tempat). Trait ini memindahkan tambalan itu ke modelnya, supaya jalur
 * yang lewat Service -- yang tidak punya kebiasaan itu -- ikut benar.
 *
 * Pembacaan ulang hanya terjadi bila memang ada atribut yang belum terisi,
 * sehingga model yang seluruh kolomnya dikirim eksplisit tidak membayar apa pun.
 */
trait HydratesDatabaseDefaults
{
    /**
     * Kolom yang nilainya berasal dari default database.
     *
     * Model dapat menimpanya lewat properti $hydrateAfterCreate bila punya
     * kolom berdefault selain 'status'.
     */
    protected function databaseDefaultAttributes(): array
    {
        return property_exists($this, 'hydrateAfterCreate')
            ? $this->hydrateAfterCreate
            : ['status'];
    }

    protected static function bootHydratesDatabaseDefaults(): void
    {
        static::created(function ($model) {
            foreach ($model->databaseDefaultAttributes() as $attribute) {
                // Kolom yang SUDAH terisi tidak perlu dibaca ulang.
                if ($model->getAttribute($attribute) !== null) {
                    continue;
                }

                // Kolom yang tidak dimiliki tabel ini dilewati: daftar
                // defaultnya ('status') tidak berlaku untuk semua tabel.
                //
                // Pertanyaannya diajukan ke SKEMA, bukan ke model. Baik
                // `hasAttribute()` maupun `getAttributes()` hanya melihat
                // atribut yang sudah dimuat -- dan kolom berdefault justru
                // TIDAK pernah termuat setelah create(), sehingga keduanya
                // menjawab false persis pada kasus yang harus ditangani.
                if (! static::hasColumnCached($model, $attribute)) {
                    continue;
                }

                // refresh() mengisi SELURUH atribut sekaligus, jadi satu
                // pembacaan cukup untuk berapa pun kolom yang tertinggal.
                $model->refresh();

                return;
            }
        });
    }

    /**
     * Apakah tabel model punya kolom ini?
     *
     * Hasilnya di-cache per proses: tanpa ini setiap insert akan menanyakan
     * skema ke database, dan trait yang dimaksudkan murah justru jadi mahal.
     *
     * @var array<string, bool>
     */
    protected static array $columnExistenceCache = [];

    protected static function hasColumnCached($model, string $column): bool
    {
        $key = $model->getConnectionName().'.'.$model->getTable().'.'.$column;

        return static::$columnExistenceCache[$key] ??= $model->getConnection()
            ->getSchemaBuilder()
            ->hasColumn($model->getTable(), $column);
    }
}
