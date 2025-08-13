# Setup Instructions untuk Sistem Informasi Alumni & Skripsi

## Prerequisites
- PHP 8.2 atau lebih tinggi
- Composer
- MySQL/MariaDB
- Node.js & NPM (untuk Vite)

## Langkah-langkah Setup

### 1. Clone atau Download Project
```bash
cd c:\Users\ASUS\OneDrive\Desktop\sisfoalumnilaravel
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
File `.env` sudah dikonfigurasi. Pastikan database MySQL berjalan dan buat database:
```sql
CREATE DATABASE sisfoalumni;
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Create Storage Link
```bash
php artisan storage:link
```

### 6. Run Migrations dan Seeder
```bash
php artisan migrate
php artisan db:seed
```

### 7. Build Assets
```bash
npm run build
```

### 8. Start Development Server
```bash
php artisan serve
```

## Import Database (Alternatif)
Jika ingin menggunakan database dump yang sudah disediakan:
1. Buka phpMyAdmin
2. Buat database baru bernama `sisfoalumni`
3. Import file `database_sisfoalumni.sql`

## Default Login Credentials

### Admin
- Email: admin@sisfoalumni.com
- Password: password

### Alumni 1
- Email: john.doe@email.com
- Password: password

### Alumni 2
- Email: jane.smith@email.com
- Password: password

## Fitur yang Tersedia

### Landing Page
- Profil program studi
- Berita terbaru
- Event mendatang
- Lowongan kerja
- Skripsi publik

### Admin Dashboard
- Kelola user (admin & alumni)
- Kelola skripsi (approve/reject)
- Kelola berita
- Kelola event
- Kelola kuisioner
- Export data kuisioner (CSV/PDF)

### Alumni Dashboard
- Edit profil lengkap
- Upload foto profil
- Kelola skripsi (upload PDF)
- Kelola lowongan kerja
- Isi kuisioner tracer study

## Struktur Folder Upload
- `storage/app/public/profiles/` - Foto profil alumni
- `storage/app/public/skripsi/` - File PDF skripsi
- `storage/app/public/berita/` - Gambar berita
- `storage/app/public/event/` - Gambar event

## Teknologi yang Digunakan
- Laravel 11
- MySQL
- Tailwind CSS
- Alpine.js
- Vite

## Catatan Penting
- Pastikan folder `storage` dan `bootstrap/cache` memiliki permission write
- Untuk production, ubah `APP_DEBUG=false` di file `.env`
- Konfigurasi email di `.env` untuk fitur notifikasi
- Backup database secara berkala
