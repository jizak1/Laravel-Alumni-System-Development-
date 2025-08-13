<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Event;
use App\Models\Lowongan;
use App\Models\Pertanyaan;
use App\Models\ProfilProdi;
use App\Models\Skripsi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@sisfoalumni.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create Alumni Users
        $alumni1 = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@email.com',
            'password' => Hash::make('password'),
            'role' => 'alumni',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $alumni2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@email.com',
            'password' => Hash::make('password'),
            'role' => 'alumni',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create Profiles for Alumni
        $alumni1->profile()->create([
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'telepon' => '081234567890',
            'pekerjaan' => 'Software Developer',
            'tahun_lulus' => 2023,
            'nim' => '20190001',
        ]);

        $alumni2->profile()->create([
            'alamat' => 'Jl. Sudirman No. 456, Bandung',
            'telepon' => '081234567891',
            'pekerjaan' => 'Data Analyst',
            'tahun_lulus' => 2022,
            'nim' => '20180002',
        ]);

        // Create Program Study Profile
        ProfilProdi::create([
            'nama_prodi' => 'Teknik Informatika',
            'deskripsi' => 'Program Studi Teknik Informatika menghasilkan lulusan yang kompeten di bidang teknologi informasi dan komputer.',
            'visi' => 'Menjadi program studi unggulan dalam bidang teknologi informasi yang menghasilkan lulusan berkualitas dan berdaya saing global.',
            'misi' => 'Menyelenggarakan pendidikan berkualitas, melakukan penelitian inovatif, dan mengabdi kepada masyarakat dalam bidang teknologi informasi.',
            'kontak' => '(021) 1234567',
            'email' => 'ti@university.ac.id',
            'website' => 'https://ti.university.ac.id',
        ]);

        // Create Sample Skripsi
        Skripsi::create([
            'user_id' => $alumni1->id,
            'judul' => 'Sistem Informasi Manajemen Perpustakaan Berbasis Web',
            'abstrak' => 'Penelitian ini membahas pengembangan sistem informasi manajemen perpustakaan menggunakan teknologi web untuk meningkatkan efisiensi pengelolaan buku dan layanan perpustakaan.',
            'status' => 'approved',
            'akses' => 'public',
            'tahun' => 2023,
            'pembimbing1' => 'Dr. Ahmad Fauzi, M.Kom',
            'pembimbing2' => 'Ir. Siti Nurhaliza, M.T',
        ]);

        Skripsi::create([
            'user_id' => $alumni2->id,
            'judul' => 'Analisis Sentimen Media Sosial Menggunakan Machine Learning',
            'abstrak' => 'Penelitian ini menganalisis sentimen pengguna media sosial terhadap produk atau layanan menggunakan algoritma machine learning untuk memberikan insights bisnis.',
            'status' => 'approved',
            'akses' => 'public',
            'tahun' => 2022,
            'pembimbing1' => 'Prof. Dr. Budi Santoso, M.Kom',
            'pembimbing2' => 'Dr. Lisa Permata, M.Kom',
        ]);

        // Create Sample Job Opportunities
        Lowongan::create([
            'user_id' => $alumni1->id,
            'judul' => 'Software Developer',
            'deskripsi' => 'Dicari software developer dengan pengalaman minimal 2 tahun dalam pengembangan web.',
            'perusahaan' => 'PT. Teknologi Maju',
            'lokasi' => 'Jakarta',
            'link' => 'https://example.com/apply',
            'tanggal_posting' => now(),
            'tanggal_berakhir' => now()->addMonth(),
            'status' => 'active',
        ]);

        Lowongan::create([
            'user_id' => $alumni2->id,
            'judul' => 'Data Analyst',
            'deskripsi' => 'Posisi data analyst untuk menganalisis data bisnis dan membuat laporan insights.',
            'perusahaan' => 'PT. Data Solutions',
            'lokasi' => 'Bandung',
            'link' => 'https://example.com/apply2',
            'tanggal_posting' => now(),
            'tanggal_berakhir' => now()->addDays(17),
            'status' => 'active',
        ]);

        // Create Sample News
        Berita::create([
            'judul' => 'Selamat Datang di Sistem Informasi Alumni',
            'konten' => 'Sistem Informasi Alumni & Skripsi telah resmi diluncurkan untuk memfasilitasi komunikasi antara alumni dan institusi.',
            'tanggal_posting' => now(),
            'status' => 'published',
        ]);

        Berita::create([
            'judul' => 'Workshop Alumni: Pengembangan Karir di Era Digital',
            'konten' => 'Alumni diundang untuk mengikuti workshop pengembangan karir yang akan diadakan bulan depan.',
            'tanggal_posting' => now(),
            'status' => 'published',
        ]);

        // Create Sample Events
        Event::create([
            'judul' => 'Reuni Alumni 2025',
            'deskripsi' => 'Acara reuni tahunan alumni untuk mempererat silaturahmi dan berbagi pengalaman.',
            'tanggal' => now()->addMonth(),
            'lokasi' => 'Auditorium Kampus',
            'status' => 'upcoming',
        ]);

        Event::create([
            'judul' => 'Seminar Teknologi Terkini',
            'deskripsi' => 'Seminar tentang perkembangan teknologi terbaru dan dampaknya terhadap industri.',
            'tanggal' => now()->addDays(12),
            'lokasi' => 'Ruang Seminar Lt. 3',
            'status' => 'upcoming',
        ]);

        // Create Sample Questions for Questionnaire
        Pertanyaan::create([
            'teks' => 'Bagaimana penilaian Anda terhadap kualitas pendidikan yang diterima?',
            'tipe' => 'radio',
            'opsi' => ['Sangat Baik', 'Baik', 'Cukup', 'Kurang'],
            'wajib' => true,
            'urutan' => 1,
        ]);

        Pertanyaan::create([
            'teks' => 'Apakah Anda sudah mendapatkan pekerjaan setelah lulus?',
            'tipe' => 'radio',
            'opsi' => ['Ya', 'Tidak', 'Masih Mencari'],
            'wajib' => true,
            'urutan' => 2,
        ]);

        Pertanyaan::create([
            'teks' => 'Berapa lama waktu yang dibutuhkan untuk mendapatkan pekerjaan pertama?',
            'tipe' => 'select',
            'opsi' => ['< 3 bulan', '3-6 bulan', '6-12 bulan', '> 12 bulan', 'Belum bekerja'],
            'wajib' => false,
            'urutan' => 3,
        ]);

        Pertanyaan::create([
            'teks' => 'Saran untuk perbaikan program studi',
            'tipe' => 'text',
            'opsi' => null,
            'wajib' => false,
            'urutan' => 4,
        ]);
    }
}
