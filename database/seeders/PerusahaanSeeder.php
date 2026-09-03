<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perusahaan;

/**
 * PERUSAHAAN SEEDER
 * ==================
 * Seeder = file yang mengisi database dengan data contoh/awal.
 * Data di sini hanya untuk development/testing, bukan production.
 *
 * Data yang di-insert:
 * 1. PT Sinergi Digital Nusantara — Software House, kuota 40
 * 2. CV Karya Teknologi — Jaringan & Infrastruktur IT, kuota 5
 *
 * DATA DUMMY TAMBAHAN (3 perusahaan baru):
 * 3. PT Nusantara Software — Software House & Startup, kuota 30
 * 4. PT Telekomunikasi Jaringan Nusantara — Telekomunikasi & Jaringan, kuota 25
 * 5. CV Digital Media Kreatif — Multimedia & Desain Grafis, kuota 15
 */
class PerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        // Array berisi data perusahaan
        $data = [
            [
                'nama_perusahaan' => 'PT Sinergi Digital Nusantara',
                'bidang_usaha' => 'Software House',
                'alamat' => 'Jl. Soekarno Hatta No. 10, Bandung',
                'nama_pembimbing_industri' => 'Andi Saputra',
                'kuota' => 40,
            ],
            [
                'nama_perusahaan' => 'CV Karya Teknologi',
                'bidang_usaha' => 'Jaringan & Infrastruktur IT',
                'alamat' => 'Jl. Soreang-Banjaran No. 25, Kab. Bandung',
                'nama_pembimbing_industri' => 'Siti Amelia',
                'kuota' => 5,
            ],
            [
                'nama_perusahaan' => 'PT Nusantara Software',
                'bidang_usaha' => 'Software House & Startup',
                'alamat' => 'Jl. Asia Afrika No. 88, Bandung',
                'nama_pembimbing_industri' => 'Budi Hartono',
                'kuota' => 30,
            ],
            [
                'nama_perusahaan' => 'PT Telekomunikasi Jaringan Nusantara',
                'bidang_usaha' => 'Telekomunikasi & Jaringan',
                'alamat' => 'Jl. Jend. Sudirman No. 12, Jakarta',
                'nama_pembimbing_industri' => 'Rina Wulandari',
                'kuota' => 25,
            ],
            [
                'nama_perusahaan' => 'CV Digital Media Kreatif',
                'bidang_usaha' => 'Multimedia & Desain Grafis',
                'alamat' => 'Jl. Dipatiukur No. 45, Bandung',
                'nama_pembimbing_industri' => 'Dewi Lestari',
                'kuota' => 15,
            ],

            // ===== PERUSAHAAN BARU (satu perusahaan spesifik per jurusan) =====
            [
                'nama_perusahaan' => 'PT Game Studio Indonesia',
                'bidang_usaha' => 'Game Development & Studio',
                'alamat' => 'Jl. Merdeka No. 77, Bandung',
                'nama_pembimbing_industri' => 'Sultan Gaming Sengit',
                'kuota' => 0,
            ],
            [
                'nama_perusahaan' => 'PT Cloudindo Solusi Cloud',
                'bidang_usaha' => 'Cloud Computing & Infrastruktur',
                'alamat' => 'Jl. Thamrin No. 21, Jakarta',
                'nama_pembimbing_industri' => 'Devan Cloud Wanderer',
                'kuota' => 0,
            ],
            [
                'nama_perusahaan' => 'PT Cyber Security Solutions',
                'bidang_usaha' => 'Keamanan Siber',
                'alamat' => 'Jl. Asia Afrika No. 55, Bandung',
                'nama_pembimbing_industri' => 'Nia Hacker Baik',
                'kuota' => 0,
            ],
            [
                'nama_perusahaan' => 'PT Data Analytics Indonesia',
                'bidang_usaha' => 'Data Science & Analitik',
                'alamat' => 'Jl. Sudirman No. 40, Jakarta',
                'nama_pembimbing_industri' => 'Raka Data Gede',
                'kuota' => 0,
            ],
            [
                'nama_perusahaan' => 'PT Solusi Teknologi IT',
                'bidang_usaha' => 'IT Support & Infrastruktur',
                'alamat' => 'Jl. Dago No. 12, Bandung',
                'nama_pembimbing_industri' => 'Lina Nanya Jem',
                'kuota' => 0,
            ],
        ];

        // Loop array → buat/update 1 baris per item di database.
        // updateOrCreate = kalau nama perusahaan sudah ada, UPDATE; kalau belum, CREATE.
        // Ini mencegah duplikat saat seeder dijalankan berkali-kali.
        foreach ($data as $item) {
            Perusahaan::updateOrCreate(
                ['nama_perusahaan' => $item['nama_perusahaan']], // cek berdasarkan nama perusahaan
                $item                                           // data yang diisi/diperbarui
            );
        }
    }
}
