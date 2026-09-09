# RME-Backend

Backend modular untuk sistem Rumah Sakit dan Rekam Medis Elektronik (RME). Aplikasi ini dibangun sebagai modular monolith berbasis Laravel, dengan pemisahan domain ke dalam banyak modul agar setiap area bisnis dapat dikembangkan, diuji, dan dipelihara secara terpisah.

## Stack Utama

- PHP 8.3+
- Laravel 13
- Laravel Sanctum untuk autentikasi API
- Spatie Laravel Permission untuk role dan permission
- nwidart/laravel-modules untuk struktur modular
- PHPUnit untuk automated test

## Ruang Lingkup Domain

Backend ini mencakup beberapa domain besar sistem rumah sakit:

- Autentikasi dan otorisasi
- Data master umum
- Pendaftaran pasien
- Visit atau kunjungan pasien
- Rekam medis
- Layanan klinis dan penunjang
- Billing dan pembayaran
- Inventory
- BPJS
- SatuSehat
- Audit dan logging
- System license guard

## Arsitektur Modul

Proyek ini menggunakan pendekatan modular monolith. Jumlah modul yang besar adalah keputusan desain yang disengaja untuk menjaga isolasi fitur dan domain.

Konvensi umum:

- Setiap modul berada di direktori `Modules/<NamaModul>`.
- Route API modul biasanya berada di `Modules/<NamaModul>/routes/api.php`.
- Controller berada di `Modules/<NamaModul>/app/Http/Controllers`.
- FormRequest berada di `Modules/<NamaModul>/app/Http/Requests`.
- Model berada di `Modules/<NamaModul>/app/Models`.
- Migration berada di `Modules/<NamaModul>/database/migrations`.
- Test modul berada di `Modules/<NamaModul>/tests`.

Autoloading namespace `Modules\...` juga didukung dari `bootstrap/app.php`.

## Setup Lokal

Salin environment file:

```bash
cp .env.example .env
```

Install dependency:

```bash
composer install
```

Generate application key:

```bash
php artisan key:generate
```

Jalankan migration:

```bash
php artisan migrate
```

Jalankan server lokal:

```bash
php artisan serve
```

Sesuaikan konfigurasi database, cache, queue, storage, license, dan integrasi eksternal di `.env`.

## Autentikasi dan Otorisasi

API menggunakan Laravel Sanctum untuk autentikasi. Endpoint yang membutuhkan login umumnya memakai middleware:

```php
auth:sanctum
```

Role dan permission dikelola menggunakan Spatie Laravel Permission. Modul otorisasi harus dijaga ketat karena berisi endpoint untuk mengelola role, permission, dan role user.

Prinsip yang harus dijaga:

- Jangan mengandalkan login saja untuk endpoint sensitif.
- Gunakan `role`, `permission`, policy, atau domain guard sesuai kebutuhan.
- Endpoint klinis, billing, inventory, dan admin harus memiliki pembatasan akses yang eksplisit.
- Untuk domain pasien dan visit, pertimbangkan scope berdasarkan ward, unit, fasilitas, pasien, atau encounter.

## Visit dan Integritas Domain

Domain `Visit` adalah proses bisnis inti dan tidak boleh diperlakukan sebagai CRUD biasa.

Operasi penting seperti admit, transfer, discharge, cancel, dan update detail harus melewati service/domain layer agar aturan berikut tetap konsisten:

- validasi state visit
- pembatasan akses ward
- sinkronisasi bed occupancy
- pengecekan billing yang terkunci
- pencatatan discharge
- event domain

Hindari update langsung ke model `Visit` untuk field seperti `status`, `ward_id`, `bed_id`, atau `discharged_at` di luar service yang memang bertanggung jawab.

## Audit Request Log

Request API dicatat oleh middleware audit. Audit log harus diperlakukan sebagai data sensitif karena dapat memuat metadata request, user, IP, endpoint, dan identifier referensi.

Pedoman:

- Gunakan allowlist untuk payload yang dicatat.
- Jangan menyimpan payload klinis atau identitas pasien mentah.
- Jangan menyimpan query string sensitif.
- Batasi akses ke endpoint audit log.
- Tetapkan retensi log yang jelas sesuai kebijakan operasional.

## System License Guard

Modul `SystemLicenseGuard` mengelola status lisensi instance, aktivasi, sinkronisasi, heartbeat, dan webhook dari central hub.

Pedoman keamanan:

- Webhook harus menggunakan signature verification.
- Secret webhook harus dikonfigurasi dan tidak boleh kosong di production.
- Endpoint publik harus diberi rate limit.
- Aktivasi online harus hanya mengarah ke central hub yang tepercaya.
- Hindari menerima URL arbitrary dari client kecuali sudah dibatasi dengan allowlist host.

## Testing

Jalankan seluruh test:

```bash
php artisan test
```

Jalankan test modul tertentu:

```bash
php artisan test Modules/NamaModul/tests
```

Untuk perubahan berisiko tinggi, prioritaskan test pada area berikut:

- Authorization dan RBAC
- Visit lifecycle
- Billing integration
- Bed occupancy
- Audit logging
- Public integration endpoint
- License guard

## Checklist Review Sebelum Merge

- Route sensitif tidak hanya memakai `auth:sanctum`.
- FormRequest `authorize()` tidak selalu `true` untuk aksi sensitif.
- Controller tidak bypass service/domain layer untuk operasi penting.
- Endpoint read/write punya scope akses yang sesuai.
- Payload audit tidak menyimpan data pasien atau klinis mentah.
- Endpoint publik punya rate limit dan validasi trust boundary.
- Perubahan visit, billing, dan bed occupancy punya test.
- Migration tidak merusak data produksi.

## Catatan Operasional

Sistem ini memiliki domain besar dan banyak modul. Saat menambah fitur baru:

- Ikuti struktur modul yang sudah ada.
- Tempatkan aturan bisnis utama di service/domain layer.
- Hindari duplikasi aturan bisnis antar controller.
- Dokumentasikan keputusan domain yang tidak jelas.
- Tambahkan test yang proporsional dengan risiko perubahan.

## Dokumen Terkait

Analisis statis awal tersedia di:

- `ANALISIS_RME_BACKEND.md`
- `docs/rme-workflow-architecture.md`
