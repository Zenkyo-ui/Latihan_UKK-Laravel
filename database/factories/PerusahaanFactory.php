<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perusahaan>
 */
class PerusahaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_perusahaan' => $this->faker->company(),
            'bidang_usaha' => $this->faker->word(),
            'alamat' => $this->faker->address(),
            'nama_pembimbing_industri' => $this->faker->name(),
            'telepon' => $this->faker->e164PhoneNumber(),
            'kuota' => $this->faker->numberBetween(5, 50),
        ];
    }
}
