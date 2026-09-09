# Arsitektur Workflow RME

## Boundary deployment

RME-Backend adalah modular monolith **single client/single faskes**. Satu
deployment aplikasi dan satu database operasional melayani satu rumah sakit
atau klinik. Jangan menambahkan `tenant_id`, tenant resolver, database per
tenant, atau global scope tenancy. Isolasi antar-client dilakukan melalui
deployment terpisah dan lisensi instalasi, bukan di dalam aggregate klinis.

## Aggregate episode RME

Satu `Visit` memiliki paling banyak satu `MedicalRecordEpisode`. Episode
menjadi sumber kebenaran lifecycle legal data klinis:

```text
open ──finalize──> finalized ──amend(reason)──> amending ──finalize──> finalized
```

- `open`: kunjungan aktif menerima catatan dan order klinis.
- `finalized`: data klinis immutable; endpoint generik tidak boleh menulis.
- `amending`: koreksi dilakukan dengan record tambahan, bukan overwrite
  histori. Alasan, aktor, waktu, dan versi dicatat pada transition log.

Episode otomatis dibuka oleh write-path klinis pertama. Finalisasi hanya
berhasil jika seluruh `EncounterFinalizationRule` dari bounded context terkait
tidak menghasilkan pelanggaran. Baseline Rawat Jalan mewajibkan:

- minimal satu catatan klinis;
- diagnosis utama;
- seluruh order laboratorium/radiologi berada pada state terminal;
- seluruh resep sudah dispensed atau cancelled.

## Kontrak antar-modul

Modul tidak boleh mengakses tabel modul lain untuk menegakkan workflow.

- Modul klinis menggunakan `MedicalRecordGate` sebelum mutasi.
- Modul penyumbang kelengkapan mengimplementasikan
  `EncounterFinalizationRule` dan hanya membaca model miliknya.
- Modul RME mengorkestrasi rule melalui container tag.
- Kunjungan, billing, stok, bed, dan ward tetap diakses melalui kontrak di
  `app/Modules/Contracts`.

Rule berikutnya ditambahkan per capability (resume pulang, konsul, hasil
penunjang, TTE), tanpa memperbesar episode service menjadi god service.

## Urutan vertical journey

Prioritas implementasi mengikuti satu perjalanan pasien, bukan jumlah modul:

1. pendaftaran dan penjamin BPJS;
2. penerimaan kunjungan/worklist;
3. TTV, catatan klinis, diagnosis, tindakan;
4. order penunjang dan resep sampai state terminal;
5. finalisasi RME dan finalisasi pelayanan;
6. finalisasi invoice dan pembayaran;
7. coding/klaim dan outbox SATUSEHAT;
8. audit serta recovery failure path.

Setiap tahap harus memiliki command eksplisit, transaksi/locking sesuai
risiko, jejak audit, failure path, dan journey test sebelum perluasan katalog.
