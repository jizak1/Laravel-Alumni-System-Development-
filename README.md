# Laravel Alumni System

Sistem Informasi Alumni berbasis Laravel untuk manajemen data alumni, berita, event, lowongan kerja, kuisioner, dan profil prodi.

## Fitur Utama
- **Manajemen Alumni**: CRUD data alumni, profil, dan riwayat pendidikan.
- **Berita & Event**: Publikasi berita dan event kampus.
- **Lowongan Kerja**: Informasi dan posting lowongan kerja untuk alumni.
- **Kuisioner**: Pengelolaan pertanyaan dan pengisian kuisioner oleh alumni.
- **Profil Prodi**: Informasi dan statistik program studi.
- **Autentikasi**: Login, registrasi, dan manajemen user berbasis Laravel Auth.

## Instalasi
1. **Clone repository**
   ```bash
   git clone https://github.com/jizak1/Laravel-Alumni-System-Development-.git
   cd Laravel-Alumni-System-Development-
   ```
2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```
3. **Copy file environment**
   ```bash
   cp .env.example .env
   ```
4. **Generate key**
   ```bash
   php artisan key:generate
   ```
5. **Migrasi dan seeder database**
   ```bash
   php artisan migrate --seed
   ```
6. **Jalankan server**
   ```bash
   php artisan serve
   ```

## Struktur Folder Penting
- `app/Models/` : Model Eloquent
- `app/Http/Controllers/` : Controller aplikasi
- `resources/views/` : Blade template
- `database/migrations/` : Migrasi database
- `database/seeders/` : Seeder data awal
- `public/` : Root web server

## Kontribusi
Pull request dan issue sangat diterima untuk pengembangan lebih lanjut.

## Lisensi
[MIT](LICENSE)
