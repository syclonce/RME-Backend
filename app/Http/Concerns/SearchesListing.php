<?php

namespace App\Http\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

/**
 * Terapkan pencarian `?name=` pada daftar.
 *
 * Frontend mengirim `?name=` dari kotak pencarian di 563 halaman
 * (`CrudDialogPage` + `WorkflowListPage`), memakai kontrak yang sama dengan
 * `AsyncCombobox`. Tapi hanya 148 dari 607 controller `index()` yang
 * membacanya — sisanya mengabaikannya diam-diam.
 *
 * Itu lebih buruk daripada tidak ada pencarian: petugas mengetik, daftarnya
 * tidak berubah, dan tidak ada apa pun di layar yang menjelaskan kenapa.
 * Diuji lewat HTTP: `GET /diagnosis-codes?name=zzzz-tidak-ada` mengembalikan
 * 5 baris yang sama seperti tanpa filter — pada tabel 40.807 baris yang paling
 * membutuhkan pencarian.
 *
 * Kolom yang dicari ditentukan dari SKEMA, bukan diasumsikan: dari 659 tabel,
 * hanya 175 punya `name` dan 160 punya `code`. Tabel tanpa kolom teks yang
 * lazim dicari (464 tabel) dilewati begitu saja — mencari di situ memang tidak
 * bermakna, dan memaksakan `where` pada kolom yang tidak ada akan menghasilkan
 * galat SQL alih-alih daftar kosong.
 */
trait SearchesListing
{
    /** Kolom yang dicoba, berurutan. Model boleh menimpanya lewat $searchable. */
    protected function searchableColumns(string $table): array
    {
        $candidates = property_exists($this, 'searchable')
            ? $this->searchable
            : ['name', 'code', 'description', 'title', 'label'];

        return array_values(array_filter(
            $candidates,
            fn (string $column) => Schema::hasColumn($table, $column),
        ));
    }

    /**
     * @param  Builder<covariant \Illuminate\Database\Eloquent\Model>  $query
     */
    protected function applySearch(Builder $query, Request $request): Builder
    {
        // Menerima `?name=` (dipakai kotak pencarian frontend dan
        // AsyncCombobox) maupun `?search=` — satu controller lama memakai nama
        // itu, dan memutusnya berarti merusak pemanggil yang sudah ada.
        $term = trim((string) ($request->string('name')->toString() ?: $request->string('search')->toString()));

        if ($term === '') {
            return $query;
        }

        $columns = $this->searchableColumns($query->getModel()->getTable());

        if ($columns === []) {
            return $query;
        }

        // Dibungkus satu grup: tanpa ini `orWhere` di sini akan lolos dari
        // pembatasan lain yang sudah dipasang pemanggil (mis. filter visit_id),
        // dan pencarian justru MEMPERLUAS hasil alih-alih mempersempitnya.
        return $query->where(function (Builder $inner) use ($columns, $term) {
            foreach ($columns as $index => $column) {
                $index === 0
                    ? $inner->where($column, 'like', '%'.$term.'%')
                    : $inner->orWhere($column, 'like', '%'.$term.'%');
            }
        });
    }
}
