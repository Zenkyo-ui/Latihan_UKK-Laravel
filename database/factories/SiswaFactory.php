<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Perusahaan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    public function definition(): array
    {
        // 1. Ambil tanggal mulai acak antara 3 bulan lalu s/d hari ini
        $tanggalMulai = $this->faker->dateTimeBetween('-3 months', 'now');

        // 2. Tanggal selesai DIPASTIKAN 3 bulan setelah tanggal mulai tersebut
        $tanggalSelesai = (clone $tanggalMulai)->modify('+3 months');

        return [
            'nis' => $this->faker->unique()->numerify('#########'),
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->randomElement(['XI RPL 1', 'XI RPL 2', 'XI TKJ 1']),
            'tanggal_mulai_pkl' => $tanggalMulai,
            'tanggal_selesai_pkl' => $tanggalSelesai,
            'perusahaan_id' => Perusahaan::inRandomOrder()->first()->id ?? Perusahaan::factory(),
        ];
    }
}