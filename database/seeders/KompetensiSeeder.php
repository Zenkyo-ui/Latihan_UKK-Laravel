<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kompetensi = [
            ['nama_kompetensi' => 'PPLG', 'deskripsi' => 'Pengembangan Perangkat Lunak dan Game', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kompetensi' => 'RPL', 'deskripsi' => 'Rekayasa Perangkat Lunak', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kompetensi' => 'TKJ', 'deskripsi' => 'Teknik Komputer dan Jaringan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kompetensi' => 'MM', 'deskripsi' => 'Multimedia', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kompetensi' => 'Mobile Development', 'deskripsi' => 'Pengembangan Aplikasi Mobile', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kompetensi' => 'Game Development', 'deskripsi' => 'Pengembangan Game', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kompetensi' => 'Cloud Computing', 'deskripsi' => 'Komputasi Awan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kompetensi' => 'Cyber Security', 'deskripsi' => 'Keamanan Siber', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kompetensi' => 'Data Science', 'deskripsi' => 'Ilmu Data dan Analitik', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kompetensi' => 'IT Support', 'deskripsi' => 'Dukungan Teknologi Informasi', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('kompetensis')->insert($kompetensi);
    }
}
