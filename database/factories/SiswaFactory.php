<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Perusahaan;

/**
 * SISWA FACTORY
 * ==============
 * Factory = cara membuat data dummy SECARA OTOMATIS pakai Faker.
 *
 * BERBEDA DENGAN SEEDER:
 * - Seeder: data hardcoded (nama = "Ahmad Rizky", kelas = "XII PPLG 1")
 * - Factory: data random otomatis (nama = Faker::name(), NIS = random number)
 *
 * CARA PAKAI:
 *   Siswa::factory()->count(10)->create();  ← buat 10 siswa random
 *   Siswa::factory()->create(['nama' => 'Budi']);  ← buat 1 siswa, nama = Budi
 *
 * $this->faker = object Faker yang otomatis tersedia di factory.
 * Faker bisa generate: nama, alamat, telepon, tanggal, angka, dll.
 */
class SiswaFactory extends Factory
{
    public function definition(): array
    {
        // 1. tanggalMulai = tanggal acak antara 3 bulan lalu s/d hari ini
        $tanggalMulai = $this->faker->dateTimeBetween('-3 months', 'now');

        // 2. tanggalSelesai = 3 bulan setelah tanggalMulai (dipastikan selalu 3 bulan)
        $tanggalSelesai = (clone $tanggalMulai)->modify('+3 months');

        return [
            // numerify('#########') = generate 9 digit angka random, contoh: "483726159"
            // unique() = pastikan tidak ada NIS yang duplikat
            'nis' => $this->faker->unique()->numerify('#########'),

            // name() = generate nama random, contoh: "John Smith"
            'nama' => $this->faker->name(),

            // randomElement() = pilih 1 dari array secara acak
            'kelas' => $this->faker->randomElement(['XI RPL 1', 'XI RPL 2', 'XI TKJ 1']),

            'tanggal_mulai_pkl' => $tanggalMulai,
            'tanggal_selesai_pkl' => $tanggalSelesai,

            // Ambil 1 perusahaan random yang sudah ada di database
            // Kalau belum ada perusahaan, buat pakai Perusahaan::factory()
            'perusahaan_id' => Perusahaan::inRandomOrder()->first()->id ?? Perusahaan::factory(),
        ];
    }
}
