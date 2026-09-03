<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * DATABASE SEEDER (PARENT)
 * =========================
 * Ini adalah "pangkalan" seeder. Semua seeder lain dipanggil dari sini.
 *
 * CARA JALANIN:
 *   php artisan db:seed            ← jalankan semua seeder
 *   php artisan migrate:fresh --seed ← buat ulang tabel + isi data
 *
 * URUTAN PENTING:
 *   1. PerusahaanSeeder    ← duluan (karena siswa butuh perusahaan_id)
 *   2. KompetensiSeeder    ← duluan (karena siswa butuh kompetensi_id)
 *   3. SiswaSeeder         ← terakhir (pakai ID dari perusahaan + kompetensi)
 *   4. PenilaianSeeder     ← paling akhir (butuh ID siswa untuk penilaian)
 *   5. SkillSeeder         ← isi daftar skill
 *   6. KompetensiSkillSeeder ← isi relasi jurusan ↔ skill (butuh jurusan + skill dulu)
 */
class DatabaseSeeder extends Seeder
{
    /**
     * $this->call() = jalankan seeder-seeder secara berurutan.
     * Urutan di sini menentukan seeder mana yang jalan duluan.
     */
    public function run(): void
    {
        $this->call([
            PerusahaanSeeder::class,       // 1. Isi data perusahaan
            KompetensiSeeder::class,       // 2. Isi data kompetensi
            SiswaSeeder::class,            // 3. Isi data siswa (butuh ID perusahaan + kompetensi)
            PenilaianSeeder::class,        // 4. Isi data penilaian (butuh ID siswa)
            SkillSeeder::class,            // 5. Isi daftar skill
            KompetensiSkillSeeder::class,  // 6. Isi relasi jurusan ↔ skill
            SiswaSkillSeeder::class,       // 7. Isi relasi siswa ↔ skill
            SiswaDummySeeder::class,       // 8. Isi sisa kuota PKL dengan siswa dummy massal
            PenempatanPerusahaanSeeder::class, // 9. Tempatkan siswa ke perusahaan sesuai jurusan (terakhir)
        ]);
    }
}
