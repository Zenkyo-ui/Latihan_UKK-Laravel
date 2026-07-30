<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
 [
 'nama_perusahaan' => 'PT Sinergi Digital Nusantara',
 'bidang_usaha' => 'Software House',
 'alamat' => 'Jl. Soekarno Hatta No. 10, Bandung',
 'nama_pembimbing_industri' => 'Andi Saputra',
 ],
 [
 'nama_perusahaan' => 'CV Karya Teknologi',
 'bidang_usaha' => 'Jaringan & Infrastruktur IT',
 'alamat' => 'Jl. Soreang-Banjaran No. 25, Kab. Bandung',
 'nama_pembimbing_industri' => 'Siti Amelia',
 ],
 ];
 foreach ($data as $item) {
 Perusahaan::create($item);
 }
    }
}
