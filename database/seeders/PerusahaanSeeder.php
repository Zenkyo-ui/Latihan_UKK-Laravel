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
        ];

        // Loop array → create 1 baris per item di database
        foreach ($data as $item) {
            Perusahaan::create($item);
        }
    }
}
