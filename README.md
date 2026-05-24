# Landing Page + Dashboard RAB Terintegrasi Laravel

Paket ini berisi template Laravel siap tempel:
- Landing page modern
- Dashboard RAB proyek
- Endpoint hitung RAB lewat Controller
- Blade layout
- Tombol cetak / PDF
- Tailwind CDN, jadi cepat jalan tanpa konfigurasi Vite

## Struktur File

Salin file sesuai folder:

```txt
routes/web.php
app/Http/Controllers/RabController.php
resources/views/layouts/app.blade.php
resources/views/pages/landing.blade.php
resources/views/pages/dashboard.blade.php
```

## Cara Pasang

1. Buat project Laravel:

```bash
composer create-project laravel/laravel rab-system
cd rab-system
```

2. Salin semua file dari paket ini ke project Laravel.

3. Jalankan server:

```bash
php artisan serve
```

4. Buka browser:

```txt
http://127.0.0.1:8000
http://127.0.0.1:8000/dashboard
```

## Route

```php
GET  /                         landing page
GET  /dashboard                dashboard RAB
POST /dashboard/rab/calculate  endpoint perhitungan RAB
```

## Catatan

- Template ini cocok untuk Laravel 11, 12, dan 13 karena memakai route, controller, Blade, CSRF, dan response JSON standar.
- Untuk production, pindahkan Tailwind CDN ke asset build Vite.
- Untuk login admin/user, integrasikan Laravel Breeze.
