<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perusahaan = \App\Models\Perusahaan::first();
        $data = [
            [
                'nis' => '22231001',
                'nama' => 'Ahmad Rizky',
                'kelas' => 'XII PPLG 1',
                'perusahaan_id' => $perusahaan ? $perusahaan->id : 1,
                'tanggal_mulai_pkl' => '2024-07-01',
                'tanggal_selesai_pkl' => '2024-12-31',
            ],
            [
                'nis' => '22231002',
                'nama' => 'Siti Nurhaliza',
                'kelas' => 'XII PPLG 2',
                'perusahaan_id' => $perusahaan ? $perusahaan->id : 1,
                'tanggal_mulai_pkl' => '2024-07-01',
                'tanggal_selesai_pkl' => '2024-12-31',
            ],
            [
                'nis' => '22231003',
                'nama' => 'Ahmad Fauzi Nugraha',
                'kelas' => 'XII PPLG 1',
                'perusahaan_id' => $perusahaan ? $perusahaan->id : 1,
                'tanggal_mulai_pkl' => '2026-08-01',
                'tanggal_selesai_pkl' => '2026-12-31',
            ],
            [
                'nis' => '22231004',
                'nama' => 'Siti Nurhaliza Putri',
                'kelas' => 'XII PPLG 2',
                'perusahaan_id' => $perusahaan ? $perusahaan->id : 1,
                'tanggal_mulai_pkl' => '2026-08-01',
                'tanggal_selesai_pkl' => '2026-12-31',
            ],
        ];

        foreach ($data as $item) {
            \App\Models\Siswa::create($item);
        }
    }
}
